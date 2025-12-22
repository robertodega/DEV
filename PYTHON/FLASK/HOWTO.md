
# project creation

- mkdir <PROJ_NAME>/
- cd <PROJ_NAME>/
- mkdir DB
- touch DB/db_init.sql
- mkdir templates static static/js static/css static/img static/docs static/docs/stipendio static/docs/mutuo
- touch app.py config.py const.py parameters.py templates/totali.html static/js/custom.js static/css/custom.css

# virtual env set

- sudo apt install python3.13-venv
- python3 -m venv venv
- source venv/bin/activate
- pip install flask mysql-connector-python

# project files customization

- nano const.py

        db_const = {
            "localhost": {"host": "localhost", "dbname": "<PROJ_NAME>", "user": "root", "pwd": ""},
            "remote": {"host": "", "dbname": "", "user": "", "pwd": ""},
        }

        tablesList = {
            "totali": "contocorrente",
            "overview": "overview",
            "bollette": "bills",
            "stipendio": "stipendio",
            "mutuo": "mutuo",
        }

        website_title = "<PROJ_NAME>"
        rootpath = "./"



- nano config.py

        import mysql.connector
        from const import db_const

        def get_db_connection(env):
            cfg = db_const.get(env, {}) or {}
            if not cfg.get("dbname"):
                cfg = db_const.get("localhost")
            return mysql.connector.connect(
                host=cfg["host"],
                user=cfg["user"],
                password=cfg["pwd"],
                database=cfg["dbname"],
            )

- nano parameters.py

        import datetime
        from flask import request


        def get_year_ref():
            return request.args.get("y", datetime.date.today().year)


        def get_page_ref():
            return request.args.get("p", "totali")


        def get_month_ref():
            return request.args.get("m", "")


        def get_parameters():
            return {
                "year_ref": get_year_ref(),
                "page_ref": get_page_ref(),
                "month_ref": get_month_ref(),
            }


        current_year = datetime.date.today().year
        allowed_years = list(range(current_year + 1, current_year - 5, -1))

# App creation

- nano app.py

        from flask import Flask, render_template, request
        from config import get_db_connection
        import const
        from parameters import get_parameters, current_year, allowed_years

        app = Flask(__name__)

        @app.route("/")
        def index():

            host = request.host.split(':', 1)[0]
            env = "remote" if host != "localhost" else host
            conn = get_db_connection(env)

            parameters_values = get_parameters()

            if(conn):
                cursor = conn.cursor()
                cursor.execute("SELECT * FROM contocorrente")
                results = cursor.fetchall()
                cursor.close()
                conn.close()
            else:
                results = {"Error in databasae reading operation"}

            return render_template("index.html",
                                parameters_values=parameters_values,
                                results=results,)

        if __name__ == "__main__":
            app.run(debug=True)

- nano templates/index.html

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <title>{{ website_title }}</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <script src="{{ url_for('static', filename='js/jquery.js') }}"></script>
            <link rel="stylesheet" href="{{ url_for('static', filename='css/bootstrap.css') }}">
            <script src="{{ url_for('static', filename='js/bootstrap.js') }}"></script>

            <link rel="icon" type="image/x-icon" href="{{ url_for('static', filename='img/favicon.ico') }}">
            <link rel="stylesheet" href="{{ url_for('static', filename='css/custom.css') }}">
        </head>

        <body>
            <div class="headerDiv">
                <div class="headerBlockDiv">
                    <div class="headerTitleDiv" id="headerPathDiv">
                        <h2><a href='{{ rootpath }}'>Finanza</a> -
                            {{ parameters_values.page_ref }}
                        </h2>
                    </div>
                    <div class="headerTitleDiv" id="headerYearFormDiv">
                        <select class="form-select form-select-sm locSelector" id="yearSelector" pageRef="{{ p }}"
                            aria-label=".form-select-sm example">
                            {% for y in allowed_years %}
                            <option value="{{ y }}" {% if refYear==y %} selected {% endif %}>{{ y }}</option>
                            {% endfor %}
                        </select>
                    </div>
                </div>
            </div>
            <ul>
                {% for result in results %}
                <li>{{ result }}</li>
                {% endfor %}
            </ul>
        </body>

        </html>

# project execution

[ from App root ]

- python3 app.py