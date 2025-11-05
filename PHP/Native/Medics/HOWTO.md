#   Structure preparation

    mkdir Medics
    cd Medics
    mkdir styles js config classes inc DB
    touch .htaccess index.php styles/custom.css js/custom.js config/config.php classes/dbman.php classes/manager.php classes/conn.php inc/functions.inc.php inc/search.inc.php DB/medics_init.sql

#   Files construction

    nano .htaccess

        RewriteEngine On
        #   RewriteRule ^<ALIAS_NAME>$ <PAGE_NAMEs>.php [L]

    nano DB/medics_init.sql

        -- phpMyAdmin SQL Dump
        -- version 5.2.1
        -- https://www.phpmyadmin.net/
        --
        -- Host: localhost
        -- Creato il: Nov 05, 2025 alle 14:14
        -- Versione del server: 10.4.28-MariaDB
        -- Versione PHP: 8.2.4
        SET
        SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

        START TRANSACTION;

        SET
        time_zone = "+00:00";

        /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

        /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

        /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

        /*!40101 SET NAMES utf8mb4 */;

        --
        -- Database: `medics`
        --
        CREATE DATABASE IF NOT EXISTS `medics` DEFAULT CHARACTER
        SET
        utf8mb4 COLLATE utf8mb4_general_ci;

        USE `medics`;

        -- --------------------------------------------------------
        --
        -- Struttura della tabella `blood_cholesterol`
        --
        DROP TABLE IF EXISTS `blood_cholesterol`;

        CREATE TABLE
        `blood_cholesterol` (
            `id` int (11) NOT NULL,
            `analysis_date` date DEFAULT NULL,
            `total_value` int (11) DEFAULT NULL,
            `total_range_min` float DEFAULT NULL,
            `total_range_max` float DEFAULT NULL,
            `hdl_value` int (11) DEFAULT NULL,
            `hdl_range_min` float DEFAULT NULL,
            `hdl_range_max` float DEFAULT NULL,
            `ldl_range_min` float DEFAULT NULL,
            `ldl_range_max` float DEFAULT NULL,
            `triglycerides_value` int (11) DEFAULT NULL,
            `triglycerides_range_min` float DEFAULT NULL,
            `triglycerides_range_max` float DEFAULT NULL
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

        -- --------------------------------------------------------
        --
        -- Struttura della tabella `blood_creatinine`
        --
        DROP TABLE IF EXISTS `blood_creatinine`;

        CREATE TABLE
        `blood_creatinine` (
            `id` int (11) NOT NULL,
            `analysis_date` date DEFAULT NULL,
            `creatinine_value` float DEFAULT NULL,
            `creatinine_range_min` float DEFAULT NULL,
            `creatinine_range_max` float DEFAULT NULL
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

        -- --------------------------------------------------------
        --
        -- Struttura della tabella `blood_platelets`
        --
        DROP TABLE IF EXISTS `blood_platelets`;

        CREATE TABLE
        `blood_platelets` (
            `id` int (11) NOT NULL,
            `analysis_date` date DEFAULT NULL,
            `platelets_number` int (11) DEFAULT NULL,
            `platelets_range_min` int (11) DEFAULT NULL,
            `platelets_range_max` int (11) DEFAULT NULL,
            `MPV` float DEFAULT NULL,
            `MPV_range_min` float DEFAULT NULL,
            `MPV_range_max` float DEFAULT NULL,
            `notes` varchar(250) DEFAULT NULL
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

        -- --------------------------------------------------------
        --
        -- Struttura della tabella `blood_psa`
        --
        DROP TABLE IF EXISTS `blood_psa`;

        CREATE TABLE
        `blood_psa` (
            `id` int (11) NOT NULL,
            `analysis_date` date DEFAULT NULL,
            `psa_value` float DEFAULT NULL,
            `psa_range_min` float DEFAULT NULL,
            `psa_range_max` float DEFAULT NULL
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

        --
        -- Indici per le tabelle scaricate
        --
        --
        -- Indici per le tabelle `blood_cholesterol`
        --
        ALTER TABLE `blood_cholesterol` ADD PRIMARY KEY (`id`);

        --
        -- Indici per le tabelle `blood_creatinine`
        --
        ALTER TABLE `blood_creatinine` ADD PRIMARY KEY (`id`);

        --
        -- Indici per le tabelle `blood_platelets`
        --
        ALTER TABLE `blood_platelets` ADD PRIMARY KEY (`id`);

        --
        -- Indici per le tabelle `blood_psa`
        --
        ALTER TABLE `blood_psa` ADD PRIMARY KEY (`id`);

        --
        -- AUTO_INCREMENT per le tabelle scaricate
        --
        --
        -- AUTO_INCREMENT per la tabella `blood_cholesterol`
        --
        ALTER TABLE `blood_cholesterol` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

        --
        -- AUTO_INCREMENT per la tabella `blood_creatinine`
        --
        ALTER TABLE `blood_creatinine` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

        --
        -- AUTO_INCREMENT per la tabella `blood_platelets`
        --
        ALTER TABLE `blood_platelets` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

        --
        -- AUTO_INCREMENT per la tabella `blood_psa`
        --
        ALTER TABLE `blood_psa` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

        COMMIT;

        /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

        /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

        /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


    nano config/config.php

        <?php
        define("DB_HOST", "localhost");
        define("DB_NAME", "medics");
        define("DB_USER", "root");
        define("DB_PWD", "");

        define("ROOT_PATH", "./");
        define("CSS_PATH", ROOT_PATH . "styles/");
        define("JS_PATH", ROOT_PATH . "js/");
        define("INC_PATH", ROOT_PATH . "inc/");
        define("CLASSES_PATH", ROOT_PATH . "classes/");
        define("IMG_PATH", ROOT_PATH . "images/");

        define("APP_TITLE", "Medics Analysis App");
        define("PAGE_TITLE", "Medics &bull; " . $currentDataRef . "");
        define("PAGE_WELCOME", "Welcome to Medics Analysis App");

        $tables_prefix = "blood_";
        $tables_titles_transcode = [
            "analysis_date" => "Analysis Date",
            "total_value" => "Total Value",
            "total_range_min" => "Range Min\n(Total Value)",
            "total_range_max" => "Range Max\n(Total Value)",
            "hdl_value" => "HDL",
            "ldl_value" => "LDL",
            "hdl_range_min" => "Range Min\n(HDL)",
            "hdl_range_max" => "Range Max\n(HDL)",
            "ldl_range_min" => "Range Min\n(LDL)",
            "ldl_range_max" => "Range Max\n(LDL)",
            "triglycerides_value" => "Triglycerides",
            "triglycerides_range_min" => "Range Min\n(Triglycerides)",
            "triglycerides_range_max" => "Range Max\n(Triglycerides)",
            "platelets_number" => "Number",
            "platelets_range_min" => "Range Min\n(Platelets)",
            "platelets_range_max" => "Range Max\n(Platelets)",
            "MPV_range_min" => "Range Min\n(MPV)",
            "MPV_range_max" => "Range Max\n(MPV)",
            "creatinine_value" => "Value",
            "creatinine_range_min" => "Range Min",
            "creatinine_range_max" => "Range Max",
            "psa_value" => "Value",
            "psa_range_min" => "Range Min",
            "psa_range_max" => "Range Max",
        ];
        $tables_values_references = [
            "platelets_number" => ["platelets_range_min", "platelets_range_max"],
            "MPV" => ["MPV_range_min", "MPV_range_max"],
            "total_value" => ["total_range_min", "total_range_max"],
            "hdl_value" => ["hdl_range_min", "hdl_range_max"],
            "triglycerides_value" => ["triglycerides_range_min", "triglycerides_range_max"],
            "psa_value" => ["psa_range_min", "psa_range_max"],
            "creatinine_value" => ["creatinine_range_min", "creatinine_range_max"],
        ];


    nano inc/functions.inc.php

        <?php
        function e($value){
            return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }

    nano search.inc.php

        <?php
        try {
            $tables = $manager->getTablesList();
        } catch (Exception $e) {
            echo $e;
        }

        if (is_array($tables)) {
            $menuList = "<ul class='menu-item-list'>";
            foreach ($tables as $t) {
                $menu_item = ucfirst(substr(e($t), strlen($tables_prefix)));
                $current = trim(strtolower($currentDataRef)) == trim(strtolower($menu_item)) ? "current" : "";
                $menuList .= "<li class='menu-item " . $current . "' onclick=\"document.location.href='?r=" . urlencode($menu_item) . "'\">" . $menu_item . "</li>";
            }
            $menuList .= "</ul>";

            try {
                $data = $manager->getData($curTable);
                $data = array_reverse($data);
                $not_allowed_keys = ['id'];

                # table header
                $tableHeadersList = [];
                foreach ($data as $d) {
                    foreach ($d as $key => $value) {
                        if (in_array($key, $not_allowed_keys)) {
                            continue;
                        }
                    
                        if(strpos($key, 'range_') !== false){
                            continue;
                        }

                        $key_name = $tables_titles_transcode[$key] ?? $key;
                        $tableHeadersList[] = "<div class='data-cell data-cell-title data-cell-".$key."'>" . nl2br(e(ucfirst($key_name))). "</div>";
                    }
                }
                $result_data = "<div class='data-row'>" . implode("", array_unique($tableHeadersList)) . "</div>";

                # table data
                foreach ($data as $d) {
                    $result_data .= "<div class='data-row'>";
                    foreach ($d as $key => $value) {
                        $evidence_cell_value = "";

                        if (in_array($key, $not_allowed_keys)) {
                            continue;
                        }
                        
                        if(strpos($key, 'range_') !== false){
                            continue;
                        }

                        $value_refs = "";
                        if(!empty($tables_values_references[$key])){
                            
                            $ref_keys_min = $tables_values_references[$key][0];
                            $ref_keys_max = $tables_values_references[$key][1];
                            $value_refs = " <span class='value-refs'>(".$d[$ref_keys_min]." - ".$d[$ref_keys_max].")</span>";

                            if(isset($d[$ref_keys_min]) && (isset($d[$ref_keys_max]))){
                                if($value < $d[$ref_keys_min] || $value > $d[$ref_keys_max]){
                                    $evidence_cell_value = "data-cell-value-out-of-range";
                                }
                            }
                            else{
                                if(!(isset($d[$ref_keys_max]))){
                                    if($value < $d[$ref_keys_min]){
                                        $evidence_cell_value = "data-cell-value-out-of-range";
                                    }
                                }
                                if(!(isset($d[$ref_keys_min]))){
                                    if($value > $d[$ref_keys_max]){
                                        $evidence_cell_value = "data-cell-value-out-of-range";
                                    }
                                }
                            }
                        }

                        $result_data .= "<div class='data-cell data-cell-".$key."'><span class='".$evidence_cell_value."'>" . e($value) . "</span>".$value_refs."</div>";
                    }
                    $result_data .= "</div>";
                }

            } catch (Exception $e) {
                echo $e;
            }
        }

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

            public function getTablesList()
            {
                // use query and fetch single column with table names
                $stmt = $this->conn->query("SHOW TABLES");
                return $stmt->fetchAll(PDO::FETCH_COLUMN);
            }
            
            public function getData($table)
            {
                // validate table name to prevent SQL injection (only allow letters, numbers and underscore)
                if (!preg_match('/^[A-Za-z0-9_]+$/', $table)) {
                    throw new InvalidArgumentException('Invalid table name');
                }

                // safe identifier quoting: escape backticks then wrap in backticks
                $tableQuoted = '`' . str_replace('`', '``', $table) . '`';

                $stmt = $this->conn->prepare("SELECT * FROM $tableQuoted");
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }

        }


    nano classes/conn.php

        <?php
        $db = new Dbman();
        $conn = $db->getConn();
        $manager = new Manager($conn);

    nano styles/custom.css

        .clearDiv {
          clear: both;
        }
        .current {
          text-decoration: underline;
          text-shadow: #ffcc00 1px 0 10px;
        }

        .page-container {
          text-align: center;
          border-bottom: 1px solid grey;
          height: 100px;
          padding-top: 20px;
          box-shadow: 0px 0px 2px 2px black;
          background-color: antiquewhite;

          a {
            text-decoration: none;
            color: black;
          }

          &.header-container {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 2rem;
            font-weight: normal;
            text-decoration: none;
            text-shadow: #ffcc00 1px 0 10px;

            h1 {
              font-weight: bold;
              text-decoration: underline;
            }

            .menu-div {
              border: 0px solid red;

              .menu-item-list {
                margin: 0 auto;
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 20px;
                font-size: 1rem;

                li {
                  list-style-type: none;
                  cursor: pointer;
                  color: orangered;
                }
                li:hover {
                  text-decoration: underline;
                  text-shadow: #ffcc00 1px 0 10px;
                }
              }
            }
          }

          &.content-container {
            margin-top: 50px;
            height: 700px;
            box-shadow: 0px 0px 0px 0px black;

            .current-ref-title {
              font-size: 2rem;
              font-weight: bold;
              text-decoration: underline;
              margin-bottom: 20px;
            }

            .result-div {
              border: 0px solid blue;
              height: 580px;
              overflow: auto;

              .data-row {
                border-bottom: 1px solid grey;
                display: flex;
                gap: 20px;
                justify-content: center;

                .data-cell {
                  border: 0px solid red;
                  width: 150px;
                }

                .data-cell-title {
                  font-weight: bold;
                  color: orangered;
                }

                .data-cell-notes {
                  width: 200px;
                }

                .data-cell-value-out-of-range{
                  color: red;
                  font-weight: bold;
                }

                .value-refs{
                  color: black;
                  font-weight: normal;
                  font-size: 0.8rem;
                }

              }

              .data-row:nth-child(2) {
                background-color: turquoise;
              }
            }

            h2 {
              font-size: 1.5rem;
            }
          }
        }


    nano index.php

        <?php

        $currentDataRef = $_GET["r"] ?? "Platelets";

        include 'config/config.php';
        include INC_PATH . 'functions.inc.php';
        include CLASSES_PATH . 'dbman.php';
        include CLASSES_PATH . 'manager.php';
        include CLASSES_PATH . 'conn.php';

        $curTable = $tables_prefix . strtolower($currentDataRef);

        include INC_PATH . 'search.inc.php';

        ?>
        <html>

        <head>
            <title><?= PAGE_TITLE ?></title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <script src="<?= JS_PATH ?>jquery.js"></script>
            <link rel="stylesheet" href="<?= CSS_PATH ?>bootstrap.css">
            <script src="<?= JS_PATH ?>bootstrap.js"></script>

            <link rel="icon" type="image/x-icon" href="<?= IMG_PATH ?>favicon.ico" />
            <link rel="stylesheet" href="<?= CSS_PATH ?>custom.css">
        </head>

        <body>
            <div class="page-container header-container">
                <h1><a href="<?= ROOT_PATH ?>" title="Home Page"><?= APP_TITLE ?></a></h1>
                <div class="menu-div"><?= $menuList ?></div>
            </div>
            <div class="page-container content-container">
                <h2><?= PAGE_WELCOME ?></h2>
                <h3 class="current-ref-title"><?= $currentDataRef ?></h3>
                <div class="result-div"><?= $result_data ?></div>
            </div>
        </body>

        </html>

        <script src="<?= JS_PATH ?>custom.js"></script>

