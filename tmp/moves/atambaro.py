import pandas as pd

inpute =pd.read_csv("movy.csv")
other =pd.read_csv("final.csv",sep=":")

inpute["description"] = other["description"]

inpute.to_csv("mitambatra.csv")
