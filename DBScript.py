import mysql.connector

class DBScript():
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        use_unicode=True,
        charset="utf8",

    )
    cursor = db.cursor()
    cursor.execute("CREATE DATABASE IF NOT EXISTS Sistemas_de_recomendacion")

    cursor.close()
    db = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="Sistemas_de_recomendacion",
        use_unicode=True,
        charset="utf8",

    )
    cursor2 = db.cursor()
    cursor2.execute("ALTER DATABASE Sistemas_de_recomendacion CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci'")
    cursor2.execute("CREATE TABLE IF NOT EXISTS movies (id INT AUTO_INCREMENT PRIMARY KEY,"
                   " title VARCHAR(255))")
    cursor2.execute("CREATE TABLE IF NOT EXISTS ratings (userid INT, movieid INT, rating FLOAT)")

    cursor2.close()