
# project creation

- mkdir Economia/
- cd Economia/
- mkdir DB
- touch DB/db_init.sql
- mkdir templates static static/js static/css static/img static/docs static/docs/stipendio static/docs/mutuo
- touch app.py config.py const.py parameters.py templates/totali.html static/js/custom.js static/css/custom.css

# virtual env set

- sudo apt install python3.13-venv
- python3 -m venv venv
- source venv/bin/activate
- pip install flask mysql-connector-python

# DB creation

- nano DB/db_init.sql

        -- phpMyAdmin SQL Dump
        -- version 5.2.1
        -- https://www.phpmyadmin.net/
        --
        -- Host: localhost
        -- Creato il: Dic 13, 2025 alle 12:54
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
        -- Database: `economia`
        --
        CREATE DATABASE IF NOT EXISTS `economia` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
        USE `economia`;

        -- --------------------------------------------------------

        --
        -- Struttura della tabella `bills`
        --

        DROP TABLE IF EXISTS `bills`;
        CREATE TABLE `bills` (
        `id` int(11) NOT NULL,
        `name` varchar(255) DEFAULT NULL,
        `ref_year` int(11) DEFAULT NULL,
        `ref_month` int(11) DEFAULT NULL,
        `payment_date` date DEFAULT NULL,
        `bill_date` date DEFAULT NULL,
        `amount` float DEFAULT NULL,
        `referral_period` text DEFAULT NULL,
        `consumption` text DEFAULT NULL,
        `note` text DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        -- --------------------------------------------------------

        --
        -- Struttura della tabella `contocorrente`
        --

        DROP TABLE IF EXISTS `contocorrente`;
        CREATE TABLE `contocorrente` (
        `id` int(11) NOT NULL,
        `saldo` float DEFAULT NULL,
        `ref_year` int(11) DEFAULT NULL,
        `ref_month` int(11) DEFAULT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        -- --------------------------------------------------------

        --
        -- Struttura della tabella `mutuo`
        --

        DROP TABLE IF EXISTS `mutuo`;
        CREATE TABLE `mutuo` (
        `id` int(11) NOT NULL,
        `ref_year` int(11) DEFAULT NULL,
        `ref_month` int(11) DEFAULT NULL,
        `payment_date` date DEFAULT NULL,
        `amount` float DEFAULT 0,
        `interests` float DEFAULT 0,
        `capital` float DEFAULT 0
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        -- --------------------------------------------------------

        --
        -- Struttura della tabella `overview`
        --

        DROP TABLE IF EXISTS `overview`;
        CREATE TABLE `overview` (
        `id` int(11) NOT NULL,
        `name` varchar(255) NOT NULL,
        `ref_year` int(11) DEFAULT NULL,
        `ref_month` int(11) DEFAULT NULL,
        `amount` float NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        -- --------------------------------------------------------

        --
        -- Struttura della tabella `stipendio`
        --

        DROP TABLE IF EXISTS `stipendio`;
        CREATE TABLE `stipendio` (
        `id` int(11) NOT NULL,
        `lordo` float DEFAULT NULL,
        `netto` float DEFAULT NULL,
        `ticket_value` float DEFAULT NULL,
        `ticket_n` int(11) DEFAULT NULL,
        `ref_year` int(11) DEFAULT NULL,
        `ref_month` int(11) DEFAULT NULL,
        `data_bonifico` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        --
        -- Indici per le tabelle scaricate
        --

        --
        -- Indici per le tabelle `bills`
        --
        ALTER TABLE `bills`
        ADD PRIMARY KEY (`id`);

        --
        -- Indici per le tabelle `contocorrente`
        --
        ALTER TABLE `contocorrente`
        ADD PRIMARY KEY (`id`);

        --
        -- Indici per le tabelle `mutuo`
        --
        ALTER TABLE `mutuo`
        ADD PRIMARY KEY (`id`);

        --
        -- Indici per le tabelle `overview`
        --
        ALTER TABLE `overview`
        ADD PRIMARY KEY (`id`);

        --
        -- Indici per le tabelle `stipendio`
        --
        ALTER TABLE `stipendio`
        ADD PRIMARY KEY (`id`);

        --
        -- AUTO_INCREMENT per le tabelle scaricate
        --

        --
        -- AUTO_INCREMENT per la tabella `bills`
        --
        ALTER TABLE `bills`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

        --
        -- AUTO_INCREMENT per la tabella `contocorrente`
        --
        ALTER TABLE `contocorrente`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

        --
        -- AUTO_INCREMENT per la tabella `mutuo`
        --
        ALTER TABLE `mutuo`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

        --
        -- AUTO_INCREMENT per la tabella `overview`
        --
        ALTER TABLE `overview`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

        --
        -- AUTO_INCREMENT per la tabella `stipendio`
        --
        ALTER TABLE `stipendio`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        COMMIT;

        /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
        /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
        /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


# project files customization

- nano const.py

        db_const = {
            "localhost": {"host": "localhost", "dbname": "economia", "user": "root", "pwd": ""},
            "remote": {"host": "", "dbname": "", "user": "", "pwd": ""},
        }

        tablesList = {
            "totali": "contocorrente",
            "overview": "overview",
            "bollette": "bills",
            "stipendio": "stipendio",
            "mutuo": "mutuo",
        }

        website_title = "Economia"
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

        app = Flask(__name__)

        @app.route("/")
        def totali():

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

            return render_template("totali.html",
                                pageValue="totali",
                                parameters_values=parameters_values,
                                results=results,)

        if __name__ == "__main__":
            app.run(debug=True)

- nano templates/totali.html

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