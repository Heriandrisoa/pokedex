import pandas as pd
import requests

#print(requests.__version__)
headers = {
    "User-agent": "AcademicClient/1.0",
    "Accept": "application/json"
}

params = {

    "q": "python",
    "page":2
}

response = requests.get("https://api.github.com", headers=headers)
data = response.json()
print(response)

print(data["current_user_url"])
