# (PYTHON) step-by-step scrape + immediate DB update + JSON backup

import os
import json
import time
import random
import requests
from bs4 import BeautifulSoup
import psycopg2

# -------- CONFIG --------
POKEDEX_JSON_URL = "https://raw.githubusercontent.com/Purukitto/pokemon-data.json/master/pokedex.json"

FR_LIST_FILE = "pokemon_fr.txt"

DB_HOST = "localhost"
DB_PORT = 5432
DB_NAME = "pokemon"
DB_USER = "postgres"
DB_PASSWORD = "a"  # or: os.getenv("PGPASSWORD", "")

TABLE = "public.pokedex"
COL_NAME_EN = "pokemon_name"
COL_DESC = "description"

SECTION_TITLE = "Physionomie et attitudes"

RESULTS_JSONL = "results.jsonl"   # backup: one JSON per line
FAIL_JSONL = "failures.jsonl"

SLEEP_MIN = 0.4
SLEEP_MAX = 1.2
TIMEOUT = 25
MAX_RETRIES = 3

# -------- HELPERS --------
def load_fr_names(path: str) -> list[str]:
    with open(path, "r", encoding="utf-8") as f:
        return [line.strip() for line in f if line.strip()]

def build_fr_to_en_map() -> dict[str, str]:
    data = requests.get(POKEDEX_JSON_URL, timeout=TIMEOUT).json()
    m = {}
    for p in data:
        en = p["name"]["english"].strip()
        fr = p["name"]["french"].strip()
        m[fr.casefold()] = en
    return m

def append_jsonl(path: str, obj: dict) -> None:
    with open(path, "a", encoding="utf-8") as f:
        f.write(json.dumps(obj, ensure_ascii=False) + "\n")

def fetch_html(url: str) -> str:
    headers = {"User-Agent": "Mozilla/5.0 (compatible; pokedex-bot/1.0)"}
    last_err = None
    for _ in range(MAX_RETRIES):
        try:
            r = requests.get(url, headers=headers, timeout=TIMEOUT)
            r.raise_for_status()
            return r.text
        except Exception as e:
            last_err = e
            time.sleep(0.8 + random.random())
    raise last_err

def extract_section_text(html: str, section_title: str) -> str:
    soup = BeautifulSoup(html, "html.parser")
    content = soup.select_one("div.mw-parser-output") or soup

    target_heading = None
    for h in content.find_all(["h2", "h3", "h4"]):
        title = h.get_text(" ", strip=True)
        if section_title in title:
            target_heading = h
            break

    if not target_heading:
        return ""

    paras = []
    for el in target_heading.find_all_next():
        if el.name in ("h2", "h3", "h4") and el is not target_heading:
            break
        if el.name == "p":
            t = el.get_text(" ", strip=True)
            if t:
                paras.append(t)

    return "\n\n".join(paras).strip()

def make_pokepedia_url(fr_name: str) -> str:
    return f"https://www.pokepedia.fr/{fr_name}"

def db_update_description(conn, desc: str, en_name: str) -> int:
    # returns number of rows updated
    sql = f"""
        UPDATE {TABLE}
        SET {COL_DESC} = %s
        WHERE {COL_NAME_EN} = %s
    """
    with conn.cursor() as cur:
        cur.execute(sql, (desc, en_name))
        return cur.rowcount

# -------- MAIN --------
def main():
    fr_names = load_fr_names(FR_LIST_FILE)
    fr_to_en = build_fr_to_en_map()

    conn = psycopg2.connect(
        host=DB_HOST, port=DB_PORT, dbname=DB_NAME, user=DB_USER, password=DB_PASSWORD
    )
    conn.autocommit = False

    ok = 0
    missing_map = 0
    missing_section = 0
    page_fail = 0
    db_fail = 0
    db_zero_updates = 0

    try:
        for fr in fr_names:
            en = fr_to_en.get(fr.casefold())
            if not en:
                missing_map += 1
                append_jsonl(FAIL_JSONL, {
                    "fr": fr, "en": None, "status": "missing_mapping"
                })
                continue

            url = make_pokepedia_url(fr)

            # 1) fetch page
            try:
                html = fetch_html(url)
            except Exception as e:
                page_fail += 1
                append_jsonl(FAIL_JSONL, {
                    "fr": fr, "en": en, "url": url, "status": "page_fetch_failed", "error": str(e)
                })
                continue

            # 2) extract description
            desc = extract_section_text(html, SECTION_TITLE)
            if not desc:
                missing_section += 1
                append_jsonl(FAIL_JSONL, {
                    "fr": fr, "en": en, "url": url, "status": "section_missing"
                })
                continue

            # 3) always backup scraped result (even if DB fails)
            append_jsonl(RESULTS_JSONL, {
                "fr": fr,
                "en": en,
                "url": url,
                "section": SECTION_TITLE,
                "description": desc
            })

            # 4) update DB immediately
            try:
                rows = db_update_description(conn, desc, en)
                conn.commit()
            except Exception as e:
                conn.rollback()
                db_fail += 1
                append_jsonl(FAIL_JSONL, {
                    "fr": fr, "en": en, "url": url, "status": "db_update_failed", "error": str(e)
                })
                continue

            if rows == 0:
                db_zero_updates += 1
                append_jsonl(FAIL_JSONL, {
                    "fr": fr, "en": en, "url": url, "status": "db_updated_0_rows"
                })
            else:
                ok += 1
                print(f"OK: {fr} -> {en} (rows={rows})")

            time.sleep(random.uniform(SLEEP_MIN, SLEEP_MAX))

    finally:
        conn.close()

    print("\n--- SUMMARY ---")
    print("ok:", ok)
    print("missing_mapping:", missing_map)
    print("page_fetch_failed:", page_fail)
    print("section_missing:", missing_section)
    print("db_update_failed:", db_fail)
    print("db_updated_0_rows:", db_zero_updates)
    print(f"backup: {RESULTS_JSONL}")
    print(f"fails:  {FAIL_JSONL}")

if __name__ == "__main__":
    main()

