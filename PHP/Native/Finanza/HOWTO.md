#   Structure preparation

    mkdir finanza
    cd finanza
    mkdir css js config classes DB
    touch .htaccess index.php css/custom.css js/custom.js config/config.php classes/dbman.php classes/manager.php

#   Files construction

    nano .htaccess

        RewriteEngine On
        #   RewriteRule ^PATH$ FILE_PATH.php [L]

    nano config/config.php

        <?php
        define("DB_HOST", "localhost");
        define("DB_NAME", "<DB_NAME>");
        define("DB_USER", "root");
        define("DB_PWD", "");

    nano classes/dbman.php

        <?php

        class Dbman
        {
            private $conn;

            public function __construct()
            {
                try {
                    $this->conn = new PDO('mysql:host=' . DB_HOST . '; dbname=' . DB_NAME . '', DB_USER, DB_PWD);
                } catch (PDOException $e) {
                    die("DB Connection failed: " . $e->getMessage());
                }
            }

            public function getConn()
            {
                return $this->conn;
            }
        }

    nano classes/manager.php

        <?php
        class Manager
        {
            private $conn;

            public function __construct($conn)
            {
                $this->conn = $conn;
            }
        }

