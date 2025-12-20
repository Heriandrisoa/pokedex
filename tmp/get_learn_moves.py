import requests
url = 'https://pokeapi.co/api/v2/pokemon/magnemite'

r = requests.get(url, timeout=10)

print('status: ', r.status_code)
data = r.json()
moves = data['moves']

for i in moves:
    print(i['move'], i['version_group_details'][0]['level_learned_at'] if  i['version_group_details'][0]['level_learned_at'] != 0 else 'No')