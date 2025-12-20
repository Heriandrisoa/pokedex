# (PYTHON) convert pokemon.txt (EN) -> pokemon_fr.txt (FR)
import sys
import requests

IN_FILE = "pokemon.txt"
OUT_FILE = "pokemon_fr.txt"
DEX_URL = "https://raw.githubusercontent.com/Purukitto/pokemon-data.json/master/pokedex.json"

# 1) charge ton fichier (anglais)
with open(IN_FILE, "r", encoding="utf-8") as f:
    english = [line.strip() for line in f if line.strip()]

# 2) récupère le pokedex JSON (EN/FR)
dex = requests.get(DEX_URL, timeout=30).json()

# 3) map: english_lower -> french
m = {}
for p in dex:
    en = p["name"]["english"].strip().lower()
    fr = p["name"]["french"].strip()
    m[en] = fr

# 4) convert + écrit (1ère lettre en majuscule)
missing = []
out = []
for en in english:
    fr = m.get(en.lower())
    if not fr:
        missing.append(en)
        fr = en  # fallback
    fr = fr[:1].upper() + fr[1:]
    out.append(fr)

with open(OUT_FILE, "w", encoding="utf-8") as f:
    f.write("\n".join(out) + "\n")

if missing:
    print("NOT FOUND:", ", ".join(missing), file=sys.stderr)
else:
    print(f"OK -> {OUT_FILE}")

