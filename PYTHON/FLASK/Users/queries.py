import mysql.connector, html
from const import db_config

def conn_open():
    conn = mysql.connector.connect(**db_config)
    return conn

def cursor_open(conn):
    cursor = conn.cursor(dictionary=True)
    return cursor

def conn_close(cursor, conn):
    cursor.close()
    conn.close()

def search_db():
    conn = conn_open()
    cursor = cursor_open(conn)

    cursor.execute("SELECT * FROM users")
    users_list = cursor.fetchall()

    conn_close(cursor, conn)
    return users_list


def add_db(username_value, pwd_value, section_value, note_value):
    conn = conn_open()
    cursor = cursor_open(conn)

    user_details = ""+username_value+", "+pwd_value+", "+section_value+", "+note_value+""
    ok_msg = ["OK", user_details]
    ko_msg = ["KO", user_details]

    try:
        sql = "INSERT INTO users (user, pwd, note) VALUES (%s, %s, %s)"
        val = (username_value, pwd_value, note_value)
        cursor.execute(sql, val)
        conn.commit()

        conn_close(cursor, conn)

    except mysql.connector.Error as err:
        conn_close(cursor, conn)
        ko_msg.append("Database error: {err}")
        return ko_msg
    except Exception as e:
        conn_close(cursor, conn)
        ko_msg.append("Unexpected error: {e}")
        return ko_msg

    
    return ok_msg
