#   ----------------------------------------------------------------------------------------------
#   $ mkdir folderName
#   $ cd folderName
#   $ python3 -m venv venv
#   $ source venv/bin/activate
#   $ pip install mysql-connector-python --break-system-packages
#   $ python3 utils.py
#   ----------------------------------------------------------------------------------------------

import os
import mysql.connector

db = mysql.connector.connect(
    host = 'localhost',
    user='root',
    password='',
    database='utils',
)

separator = ""
for i in range(100): separator += "*"
separator += "\n"

byeTxt = "\n\nThank you, bye!\n\n"+separator

searchedTerm = ''
while searchedTerm != 'esc':

    searchedTerm = input("\nSearch term ( type 'esc' to quit ):\n\n\t")

    cursor = db.cursor()

    colsQ = "SHOW COLUMNS FROM utils"

    qBody = "SELECT * FROM utils WHERE 1"
    qBody += " AND Subject LIKE '%"+searchedTerm+"%'" if searchedTerm != '' else ""

    os.system('clear')
    print()
    print()

    cursor.execute(qBody)
    for x in cursor:
        print('id:\t\t', x[0])
        print('Subject:\t', x[1])
        print('Username:\t', x[2])
        print('Password:\t', x[3])
        print('Note:\t\t', x[4])
        print()
        print()

print(byeTxt)



