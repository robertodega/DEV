# project creation

- mkdir users
- cd users
- mkdir static static/css static/js static/img templates
- touch static/css/custom.css static/js/custom.js templates/add.html templates/add_result.html templates/search_result.html templates/users.html const.py queries.py users.py

# virtual env set

- python3 -m venv venv

-   Linux
    - source venv/bin/activate
    - pip install flask mysql-connector-python
    - python3 users.py

-   Windows (powershell)
    - .\venv\Scripts\activate
    - pip install flask mysql-connector-python
    - python .\users.py

# DB creation

[ from MySQL ]

        -- phpMyAdmin SQL Dump
        -- version 5.2.1
        -- https://www.phpmyadmin.net/
        --
        -- Host: 127.0.0.1
        -- Generation Time: Oct 13, 2025 at 09:24 AM
        -- Server version: 10.4.32-MariaDB
        -- PHP Version: 8.2.12

        SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
        START TRANSACTION;
        SET time_zone = "+00:00";


        /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
        /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
        /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
        /*!40101 SET NAMES utf8mb4 */;

        --
        -- Database: `utils`
        --
        CREATE DATABASE IF NOT EXISTS `utils` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
        USE `utils`;

        -- --------------------------------------------------------

        --
        -- Table structure for table `users`
        --

        DROP TABLE IF EXISTS `users`;
        CREATE TABLE `users` (
        `id` int(11) NOT NULL,
        `subject` varchar(100) DEFAULT NULL,
        `user` varchar(100) DEFAULT NULL,
        `pwd` varchar(250) DEFAULT NULL,
        `note` varchar(250) DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

        --
        -- Dumping data for table `users`
        --

        INSERT INTO `users` (`id`, `subject`, `user`, `pwd`, `note`) VALUES
        (1, 'myfastweb', 'rcaprio711', 'Fast000#', 'account 0171045'),
        (2, 'myfastweb', 'flavio.bonomini0004', 'Fast000#', 'account 2960194'),
        (3, 'myfastweb', 'alessandra.carra', 'fast modem nexxt one', 'account 8310121');

        --
        -- Indexes for dumped tables
        --

        --
        -- Indexes for table `users`
        --
        ALTER TABLE `users`
        ADD PRIMARY KEY (`id`);

        --
        -- AUTO_INCREMENT for dumped tables
        --

        --
        -- AUTO_INCREMENT for table `users`
        --
        ALTER TABLE `users`
        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
        COMMIT;

        /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
        /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
        /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


# project files creation

- mkdir templates static static/js static/css static/img

- touch users.py config.py const.py templates/users.html static/js/custom.js static/css/custom.css

- nano const.py

        db_config = {
            'host': 'localhost',
            'user': 'root',
            'password': '',
            'database': 'utils'
        }

# users app creation

- nano users.py

        from flask import Flask, render_template
        import mysql.connector
        from const import db_config

        app = Flask(__name__)

        @app.route('/')
        def index():
            conn = mysql.connector.connect(**db_config)
            cursor = conn.cursor(dictionary=True)
            cursor.execute("SELECT * FROM users")
            users_list = cursor.fetchall()
            cursor.close()
            conn.close()
            return render_template('users.html', users_list=users_list)

        if __name__ == '__main__':
            app.run(debug=True)

- nano templates/users.html

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <title>users</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

            <link rel="icon" type="image/x-icon" href="{{ url_for('static', filename='img/favicon.ico') }}">
            <link rel="stylesheet" href="{{ url_for('static', filename='css/custom.css') }}">
        </head>

        <body>
            <section id="header">
                <h1>users</h1>
            </section>
            {% for user in users_list %}
            <li>alias: {{ users.subject }} - {{ users.user }} - {{ users.pwd }} - {{ users.note }}</li>
            {% endfor %}
        </body>
        </html>

        <script src="{{ url_for('static', filename='js/custom.js') }}"></script>

# project execution

[ from App root ]

-   Linux
    - source venv/bin/activate
    - python3 users.py

-   Windows (powershell)
    - .\venv\Scripts\activate
    - python .\users.py
