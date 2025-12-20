# (PYTHON) robust extract of "Physionomie et attitudes"
import requests
from bs4 import BeautifulSoup

url = "https://www.pokepedia.fr/Bulbizarre"
r = requests.get(url, headers={"User-Agent": "Mozilla/5.0"})
r.raise_for_status()
soup = BeautifulSoup(r.text, "html.parser")

content = soup.select_one("div.mw-parser-output") or soup  # fallback

# find the heading element (h2/h3/h4) whose text contains the section title
target_heading = None
for h in content.find_all(["h2", "h3", "h4"]):
    title = h.get_text(" ", strip=True)
    if "Physionomie et attitudes" in title:
        target_heading = h
        break

if not target_heading:
    # debug: print headings to see what the site actually serves you
    headings = [h.get_text(" ", strip=True) for h in content.find_all(["h2","h3","h4"])]
    raise RuntimeError("Section not found. Headings seen:\n- " + "\n- ".join(headings[:50]))

# collect paragraphs until next heading
paras = []
for el in target_heading.find_all_next():
    if el.name in ("h2", "h3", "h4") and el is not target_heading:
        break
    if el.name == "p":
        t = el.get_text(" ", strip=True)
        if t:
            paras.append(t)

description = "\n\n".join(paras)
print(description)

