
# project creation

- mkdir finanza/
- cd finanza/

# virtual env set

- sudo apt install python3.11-venv
- python3 -m venv venv
- source venv/bin/activate
- pip install flask mysql-connector-python

# DB creation

[ from MySQL ]

        -- phpMyAdmin SQL Dump
        -- version 5.2.1
        -- https://www.phpmyadmin.net/
        --
        -- Host: localhost
        -- Creato il: Ott 07, 2025 alle 12:44
        -- Versione del server: 10.4.28-MariaDB
        -- Versione PHP: 8.2.4

        SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
        START TRANSACTION;
        SET time_zone = "+00:00";


        /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
        /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
        /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
        /*!40101 SET NAMES utf8mb4 */;

        --
        -- Database: `finanza_Python`
        --

        -- --------------------------------------------------------

        --
        -- Struttura della tabella `overview`
        --

        DROP TABLE IF EXISTS `overview`;
        CREATE TABLE `overview` (
        `id` int(11) NOT NULL,
        `name` varchar(255) NOT NULL,
        `ref_year` varchar(255) NOT NULL,
        `ref_month` varchar(255) NOT NULL,
        `amount` float NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        --
        -- Indici per le tabelle scaricate
        --

        --
        -- Indici per le tabelle `overview`
        --
        ALTER TABLE `overview`
        ADD PRIMARY KEY (`id`),
        ADD UNIQUE KEY `name` (`name`,`ref_year`,`ref_month`);

        --
        -- AUTO_INCREMENT per la tabella `overview`
        --
        ALTER TABLE `overview`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
        COMMIT;

        /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
        /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
        /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

# project files creation

- mkdir 

        templates 
        static 
        static/js 
        static/css 
        static/img

- touch 
        
        app.py 
        config.py 
        const.py
        templates/overview.html 
        static/js/custom.js 
        static/css/custom.css

- nano config.py

        import mysql.connector

        def get_db_connection():
            return mysql.connector.connect(
                host='localhost',
                user='root',
                password='',
                database='finanza_Python'
            )

# finanza app creation

- nano app.py

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

- nano templates/overview.html

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <title>Finanza</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <script src="{{ url_for('static', filename='js/jquery.js') }}"></script>
            <link rel="stylesheet" href="{{ url_for('static', filename='css/bootstrap.css') }}">
            <script src="{{ url_for('static', filename='js/bootstrap.js') }}"></script>

            <link rel="icon" type="image/x-icon" href="{{ url_for('static', filename='img/favicon.ico') }}">
            <link rel="stylesheet" href="{{ url_for('static', filename='css/custom.css') }}">
        </head>

        <body>
            <section id="header">
                <h1>Finanza</h1><h2>{{ pageValue }}</h2>
            </section>
            
            <form action="/add_outcome" method="post">
                <input type="text" name="name" placeholder="Outcome name" required>
                <input type="text" name="ref_year" placeholder="Outcome ref_year" required>
                <input type="text" name="ref_month" placeholder="Outcome ref_month" required>
                <input type="text" name="amount" placeholder="Outcome amount" required>
                <button type="submit">Add Outcome</button>
            </form>
            <h2>Outcomes List:</h2>
            <ul>
                {% for outcome in outcomes %}
                <li>{{ outcome }}</li>
                {% endfor %}
            </ul>
        </body>

        </html>

# project execution

[ from App root ]

- python3 -m venv venv
- source venv/bin/activate
- python3 app.py