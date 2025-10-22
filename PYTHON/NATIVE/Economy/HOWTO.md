- mkdir Economy
- cd Economy
- mkdir DB
- touch contoCorrente.py conn.py main.py queries.py DB/finanza.sql

- nano DB/finanza.sql

        -- phpMyAdmin SQL Dump
        -- version 5.2.1
        -- https://www.phpmyadmin.net/
        --
        -- Host: localhost
        -- Creato il: Ott 22, 2025 alle 10:30
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
        -- Database: `finanza`
        --
        CREATE DATABASE IF NOT EXISTS `finanza` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
        USE `finanza`;

        -- --------------------------------------------------------
        --
        -- Struttura della tabella `contocorrente`
        --

        DROP TABLE IF EXISTS `contocorrente`;
        CREATE TABLE `contocorrente` (
        `id` int(11) NOT NULL,
        `amount` float DEFAULT NULL,
        `ref_year` int(11) DEFAULT NULL,
        `ref_month` int(11) DEFAULT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        --
        -- Indici per le tabelle `contocorrente`
        --
        ALTER TABLE `contocorrente`
        ADD PRIMARY KEY (`id`);

        --
        -- AUTO_INCREMENT per la tabella `contocorrente`
        --
        ALTER TABLE `contocorrente`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
        COMMIT;

        /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
        /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
        /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


- nano conn.py

        import mysql.connector

        db_config = {"host": "localhost", "user": "root", "password": "", "database": "finanza"}

        def conn_open():
            conn = mysql.connector.connect(**db_config)
            return conn

        def cursor_open(conn):
            cursor = conn.cursor(dictionary=True)
            return cursor

        def conn_close(cursor, conn):
            cursor.close()
            conn.close()

- nano queries.py

        import mysql.connector
        from conn import conn_open, cursor_open, conn_close

        def read_table(tableName):
            conn = conn_open()
            cursor = cursor_open(conn)

            cursor.execute("SELECT * FROM " + tableName)
            table_content = cursor.fetchall()

            conn_close(cursor, conn)
            return table_content

- nano contoCorrente.py

        from queries import read_table

        keys = []
        results = []
        conto_corrente = read_table('contocorrente')[::-1]

- nano main.py

        import os
        from contoCorrente import conto_corrente, keys, results

        os.system("clear")

        key_list = []
        value_list = []
        recn = 0
        for record in conto_corrente:
            for rec in record:
                if rec not in key_list:
                    key_list.append(rec)
            value_list.append(record)
            recn += 1

        for key in key_list:
            if str(key) == "amount":
                print("|", key, end='  ')
            elif (str(key) == "created_at" or str(key) == "updated_at"):
                print("|     ", key, end='     ')
            else:
                print("|", key, end=' ')
        print("|")

        for record in value_list:
            for key in key_list:
                value = record[key]
                if len(str(value)) >= 7:
                    print("|", value, end=' ')
                elif len(str(value)) >= 5:
                    print("|", value, end='  ')
                elif len(str(value)) == 1:
                    if str(key) == "ref_month":
                        print("|    ", value, end='     ')
                    else:
                        print("|", value, end='  ')
                else:
                    if str(key) == "ref_year":
                        print("|  ", value, end='   ')
                    elif str(key) == "ref_month":
                        print("|    ", value, end='    ')
                    else:
                        print("|", value, end=' ')
            print("|")

- python3 -m venv venv

-   Linux
    - source venv/bin/activate
    - pip install mysql-connector-python
    - python3 contoCorrente.py

-   Windows (powershell)
    - .\venv\Scripts\activate
    - pip install mysql-connector-python
    - python .\contoCorrente.py


