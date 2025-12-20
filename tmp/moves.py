import requests

url = "https://pokedex.org/#/pokemon/1"
r = requests.get(url, timeout=10)
r.raise_for_status()

with open("page.html", "w", encoding="utf-8") as f:
    f.write(r.text)

print("✅ Sauvegardé dans page.html")
