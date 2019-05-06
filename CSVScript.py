import csv
import mysql.connector
import pandas as pd



class CSVScript():

    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="Sistemas_de_recomendacion",
        charset="utf8mb4",
        use_unicode=True

    )
    titles = []
    userid = []
    movieid = []
    rating = []

    bool=True
    bool1=True
    bool2=True

    data = pd.read_csv("./movies.csv")
    data = data.values.tolist()

    for a in data:
        for b in a:
            if bool == True:
                bool=False
                bool1=False
            elif bool1 == False:
                titles.append(str(b))
                bool1 = True
                bool2 = False
            elif bool2 == False:
                bool=True
                bool1=True

    bool=True
    bool1=True
    bool2=True
    bool3=True

    data2 = pd.read_csv("./ratings.csv")
    data2 = data2.values.tolist()

    for i in data2:
        for j in i:
            if bool == True:
                bool = False
                bool1 = False
                userid.append(int(j))
            elif bool1 == False:
                bool1 = True
                bool2 = False
                movieid.append(int(j))
            elif bool2 == False:
                bool2 = True
                bool3 = False
                rating.append(float(j))

            elif bool3 == False:
                bool3 = True
                bool = True
            
    cursor = db.cursor()

    i = 0

    for i in range(0, len(titles)):
        query = """INSERT INTO movies (title) VALUES (%s)"""
        cursor.execute(query,[titles[i]])
        i = i + 1

    j = 0
    for j in range(0, len(userid)):
        query2 = """INSERT INTO ratings (userid,movieid,rating) VALUES (%s,%s,%s)"""
        cursor.execute(query2, [userid[j],movieid[j],rating[j]])
        j = j + 1
    cursor.close()