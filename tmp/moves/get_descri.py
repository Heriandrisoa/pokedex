import requests
import pandas as pd

INPUT_FILE="nom_movy.csv"
BASE_URL="https://pokeapi.co/api/v2/move/"
OUTPUT_FILE="vaovao.csv"
def get_move(move):
    request = BASE_URL + move
    res = requests.get(request, timeout=5)
    descri = "none"

    if res.status_code != 200:
        print(f"couldn't get {move}")
        return descri

    data = res.json()
    flavor_texts = data["flavor_text_entries"]

    for i in flavor_texts:
        if i["language"]["name"] == "en":
            descri = i["flavor_text"]
            #on ne met pas de break pour obtenir la derniere version de la description
    return descri

moves = []
df = pd.read_csv(INPUT_FILE)
i = 0
for row in df.itertuples(index=False):
    descri = get_move(row.name)
    moves.append(descri)
    print(f"number {i}: {row.name} -- > {descri}")
    i+=1
df["description"] = moves

df.to_csv(OUTPUT_FILE)
    

