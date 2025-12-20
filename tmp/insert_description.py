# (PYTHON) update from results.jsonl using english name forced to lowercase

import json
import psycopg2

JSONL_FILE = "results.jsonl"

DB_HOST = "localhost"
DB_PORT = 5432
DB_NAME = "pokemon"
DB_USER = "postgres"
DB_PASSWORD = "a"

TABLE = "public.pokedex"
COL_NAME_EN = "pokemon_name"   # your DB has english names in lower
COL_DESC = "description"

ZERO_UPDATES_LOG = "update_0_rows.jsonl"
ERRORS_LOG = "update_errors.jsonl"


def append_jsonl(path: str, obj: dict) -> None:
    with open(path, "a", encoding="utf-8") as f:
        f.write(json.dumps(obj, ensure_ascii=False) + "\n")


def main():
    conn = psycopg2.connect(
        host=DB_HOST, port=DB_PORT, dbname=DB_NAME, user=DB_USER, password=DB_PASSWORD
    )
    conn.autocommit = False

    updated = 0
    zero = 0
    errors = 0
    total = 0

    # Match by DB name lowercased too (extra safe)
    sql = f"""
        UPDATE {TABLE}
        SET {COL_DESC} = %s
        WHERE lower({COL_NAME_EN}) = %s
    """

    try:
        with open(JSONL_FILE, "r", encoding="utf-8") as f, conn.cursor() as cur:
            for line in f:
                line = line.strip()
                if not line:
                    continue

                total += 1
                obj = json.loads(line)

                en = obj.get("en")
                desc = obj.get("description")
                if not en or not desc:
                    continue

                en_lower = en.strip().lower()

                try:
                    cur.execute(sql, (desc, en_lower))
                    if cur.rowcount == 0:
                        conn.rollback()
                        zero += 1
                        append_jsonl(ZERO_UPDATES_LOG, {
                            "en": en,
                            "en_lower": en_lower,
                            "fr": obj.get("fr"),
                            "url": obj.get("url"),
                            "reason": "0 rows updated"
                        })
                    else:
                        conn.commit()
                        updated += 1

                except Exception as e:
                    conn.rollback()
                    errors += 1
                    append_jsonl(ERRORS_LOG, {
                        "en": en,
                        "en_lower": en_lower,
                        "fr": obj.get("fr"),
                        "url": obj.get("url"),
                        "error": str(e)
                    })

    finally:
        conn.close()

    print("--- SUMMARY ---")
    print("total lines:", total)
    print("updated:", updated)
    print("0 rows:", zero, f"(see {ZERO_UPDATES_LOG})")
    print("errors:", errors, f"(see {ERRORS_LOG})")


if __name__ == "__main__":
    main()

