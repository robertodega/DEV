import mysql.connector
import os

#   python3 -m pip install mysql-connector-python

os.system('cls')

def get_db_connection():
    return mysql.connector.connect(
        host=db_const["localhost"]["host"],
        user=db_const["localhost"]["user"],
        password=db_const["localhost"]["pwd"],
        database=db_const["localhost"]["dbname"],
    )

db_const = {
    "localhost": {"host": "localhost", "dbname": "utils", "user": "root", "pwd": ""},
    "remote": {"host": "", "dbname": "", "user": "", "pwd": ""},
}

if __name__ == "__main__":
    conn = get_db_connection()
    results = ""
    table_name = input('Input the table name: ')

    if conn:
        try:
            cursor = conn.cursor()
            cursor.execute("SELECT * FROM "+table_name+"")
            users = cursor.fetchall()
            cursor.close()
            conn.close()

            results = "Database connection successful\n\n"

            if users is not None:
                for user in users:
                    results += f"ID: {user[0]}, Name: {user[1]}, Email: {user[2]}\n"
            else:
                results += "No data for table "+table_name+""

        except Exception as e:
            #   results = {e}
            print(f"{e}")
        
    else:
        results = "Error in databasae reading operation"

    print(results)
