from flask import Flask, render_template, request
from config import get_db_connection
import const

app = Flask(__name__)

@app.route("/")
def overview():
    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute("SELECT * FROM overview")
    outcomes = cursor.fetchall()
    cursor.close()
    conn.close()
    return render_template("overview.html",
                           pageValue="overview",
                           outcomes=outcomes,)


@app.route("/add_outcome", methods=["POST"])
def add_outcome():

    name = request.form["name"]
    ref_year = request.form["ref_year"]
    ref_month = request.form["ref_month"]
    amount = request.form["amount"]

    conn = get_db_connection()
    cursor = conn.cursor()
    cursor.execute(
        "INSERT INTO overview (name, ref_year, ref_month, amount) VALUES (%s, %s, %s, %s)",
        (name, ref_year, ref_month, amount),
    )
    conn.commit()
    cursor.close()
    conn.close()
    return "Outcome has been added successfully<hr /><a href='/'>Go Back</a>"


if __name__ == "__main__":
    app.run(debug=True)