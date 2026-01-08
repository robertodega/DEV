
# project creation

- mkdir utils
- cd utils
- mkdir DB templates static static/js static/css static/img static/docs
- touch DB/db_init.sql app.py config.py const.py parameters.py static/js/custom.js static/js/bootstrap.js static/js/jquery.js static/css/custom.css static/css/bootstrap.css templates/index.html

    -   ( copiare bootstrap.css, bootstrap.js e jquery.js dal relativo file online )

# virtual env set

- sudo apt install python3.13-venv
- python3 -m venv venv
- source venv/bin/activate
- pip install flask mysql-connector-python

# project files customization

- nano const.py

        db_const = {
            "localhost": {"host": "localhost", "dbname": "utils", "user": "root", "pwd": ""},
            "remote": {"host": "", "dbname": "", "user": "", "pwd": ""},
        }

        website_title = "utils"
        utils_table_name = "utils"
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

        from flask import request

        def get_search_ref():
            return request.args.get("s", "")

# App creation

- nano app.py

        from flask import Flask, render_template, request
        from config import get_db_connection
        import const
        from parameters import get_search_ref

        app = Flask(__name__)


        @app.route("/")
        def index():

            host = request.host.split(":", 1)[0]
            env = "remote" if host != "localhost" else host
            conn = get_db_connection(env)

            search_ref = get_search_ref()
            results = ''

            if conn:
                if search_ref:
                    try:
                        if search_ref != "all":
                            cursor = conn.cursor()
                            cursor.execute(
                                "SELECT * FROM {} WHERE subject LIKE %s OR username LIKE %s OR note LIKE %s".format(
                                    const.utils_table_name
                                ),
                                ("%" + search_ref + "%", "%" + search_ref + "%", "%" + search_ref + "%")
                            )
                            results = cursor.fetchall()
                            cursor.close()
                        else:
                            cursor = conn.cursor()
                            cursor.execute("SELECT * FROM {}".format(const.utils_table_name))
                            results = cursor.fetchall()
                            cursor.close()
                    except Exception as e:
                        results = {"Database query error: {}".format(e)}
                    finally:
                        conn.close()
            else:
                results = {"Error in database reading operation"}

            return render_template(
                "index.html",
                search_ref=search_ref,
                results=results,
            )


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
                        <h2><a href='{{ rootpath }}'>{{ website_title }}</a></h2>
                    </div>
                </div>
            </div>

            <div class="form-div">
                <div class="utils-form-div" id="search-form-div">
                    <form action="{{ rootpath }}" method="get" id="search-form">
                        <input type="text" name="s" id="search-input" class="utils-input" placeholder="Enter search term"
                            value="{{ search_ref }}">
                        <input type="submit" value="Search" id="search-submit" class="utils-button">
                        <input type="submit" value="Reset" id="search-reset" name="search-reset" class="utils-button">
                    </form>
                </div>

                <div class="value-div" id="search-value-div">
                    <span class="evidence">{{ results|length }}</span> results found
                    {% if search_ref %}with keyword "<span class="evidence">{{ search_ref }}</span>"{% endif %}
                </div>
            </div>

            <div class="result-div" id="result-div">
                {% if results %}
                <table class='table table-striped table-bordered results-table-labels'>
                    <thead>
                        <tr>
                            <th class="table_cell table_head_title">Subject</th>
                            <th class="table_cell table_head_title">Username</th>
                            <th class="table_cell table_head_title">Password</th>
                            <th class="table_cell table_head_title">Note</th>
                        </tr>
                    </thead>
                </table>
                <div class="results-table-div" id="results-table-body-div">
                    <table class='table table-striped table-bordered results-table-body'>
                        <tbody>
                            {% for result in results %}
                            <tr>
                                <td class="table_cell">{{ result[1] }}</td>
                                <td class="table_cell">{{ result[2] }}</td>
                                <td class="table_cell">{{ result[3] }}</td>
                                <td class="table_cell">{{ result[4] }}</td>
                            </tr>
                            {% endfor %}
                        </tbody>
                    </table>
                </div>
                {% endif %}
            </div>
        </body>

        </html>

        <script src="{{ url_for('static', filename='js/custom.js') }}"></script>

-   nano static/js/custom.js

        $('#search-reset').on('click', function() {
            $('#search-input').val('');
        });

-   nano static/js/custom.css

        .table_cell {
            text-align: center;
            width: 20%;
        }

        .evidence {
            font-weight: bold;
            color: #2a9d8f;
        }

        .form-div{
            display: flex;
            gap: 20px;
            padding: 1%;

            #search-value-div{
                border: 0px solid red;
                font-weight: normal;
            }
        }

        #result-div {
            .results-table-labels {
                .table_cell {
                font-weight: bold;
                background-color: #f2f2f2;
                }
            }
            .results-table-div {
                height: 700px;
                overflow: auto;
            }
        }


# project execution

[ from App root ]

- python3 ./app.py