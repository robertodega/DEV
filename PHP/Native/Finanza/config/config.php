<?php
//	DB constants
$env = ($_SERVER["HTTP_HOST"] !== "localhost") ? "remote" : $_SERVER["HTTP_HOST"];

$dbConst = [
    "localhost" => [
        "host" => "localhost",
        "dbname" => "finanza",
        "user" => "root",
        "pwd" => ""
    ],
    "remote" => [
        "host" => "",
        "dbname" => "",
        "user" => "",
        "pwd" => ""
    ]
];
define("DB_HOST", $dbConst["" . $env . ""]["host"]);
define("DB_NAME", $dbConst["" . $env . ""]["dbname"]);
define("DB_USER", $dbConst["" . $env . ""]["user"]);
define("DB_PWD", $dbConst["" . $env . ""]["pwd"]);

define("ROOT_PATH", "./");
define("CLASSES_PATH", ROOT_PATH . "classes/");
define("INCLUDE_PATH", ROOT_PATH . "include/");
define("CONFIG_PATH", ROOT_PATH . "config/");
define("DB_PATH", ROOT_PATH . "DB/");
define("CSS_PATH", ROOT_PATH . "css/");
define("JS_PATH", ROOT_PATH . "js/");
define("ASSETS_PATH", ROOT_PATH . "assets/");
define("IMG_PATH", ASSETS_PATH . "img/");
define("DOCS_PATH", ASSETS_PATH . "docs/");
define("MUTUO_DOCS_PATH", DOCS_PATH . "mutuo/");
define("INCOME_DOCS_PATH", DOCS_PATH . "stipendio/");
define("CHARTS_JS_PATH", ASSETS_PATH . "charts/");

define("MUTUO_START_YEAR", 2022);

define("WEBSITE_OWNER", "Roberto De Gaetano");
define("WEBSITE_OWNER_NICK", "RobDeGa");
define("WEBSITE_TITLE", "Finanza&nbsp;&bull;&nbsp;" . WEBSITE_OWNER_NICK . "");
define("DOCNOTFOUND_TITLE", "Doc Not Found");
define("DOCNOTFOUND_MSG", "The document you were looking for doesn't exist.");
define("DOCNOTFOUND_MSG_2", "Maybe it has not been uploaded yet.");

$months = [
    'Gennaio' => '1',
    'Febbraio' => '2',
    'Marzo' => '3',
    'Aprile' => '4',
    'Maggio' => '5',
    'Giugno' => '6',
    'Luglio' => '7',
    'Agosto' => '8',
    'Settembre' => '9',
    'Ottobre' => '10',
    'Novembre' => '11',
    'Dicembre' => '12'
];

$menuTags = [
    "totali",
    "overview",
    "bollette",
    "stipendio",
    "mutuo",
];
$pageRefs = $menuTags;
$pageRefs[] = "backup";
$pageRefs[] = "backupDb";

$tablesList = [
    "totali" => "contocorrente",
    "overview" => "overview",
    "bollette" => "bills",
    "stipendio" => "stipendio",
    "mutuo" => "mutuo",
];

$datetime_fields = [
    'payment_date' => 'Data pagamento',
    'bill_date' => 'Data fattura'
];

$allowedTags = [
    "totali" => ['spese_fisse', 'spese_extra', 'spese_totali', 'saldo'],
    "overview" => ['auto - Bollo', 'auto - Assicurazione', 'auto - Gomme', 'auto - Carburante', 'silat - Sporting', 'silat - Mike', 'bollette', 'siti_web', 'mutuo', 'viaggi'],
    "bollette" => ['luce', 'gas', 'acqua', 'spazzatura', 'internet', 'netflix', 'amazon_prime', 'assicurazione_casa', 'alleanza', 'telepass'],
    "stipendio" => ['lordo', 'netto', 'ticket_n', 'ticket_value', 'taxes', 'taxes_perc', 'tot_income'],
    "mutuo" => ['payment_date', 'amount', 'interests', 'capital'],
];

$editableTags = [
    "totali" => ['saldo'],
    "overview" => ['auto - Bollo', 'auto - Assicurazione', 'auto - Gomme', 'auto - Carburante', 'silat - Sporting', 'silat - Mike', 'siti_web', 'viaggi'],
    "bollette" => ['luce', 'gas', 'acqua', 'spazzatura', 'internet', 'netflix', 'amazon_prime', 'assicurazione_casa', 'alleanza', 'telepass'],
    "stipendio" => ['lordo', 'netto', 'ticket_n', 'ticket_value'],
    "mutuo" => ['payment_date', 'amount', 'interests', 'capital'],
];

$graphType = [
    "totali" => "Pie",
    "overview" => "Pie",
    "bollette" => "Pie",
    "stipendio" => "Pie",
    "mutuo" => "Pie",
];

$graphAllowedTags = [
    "totali" => ['spese_fisse', 'spese_extra', 'spese_totali', 'saldo'],
    "overview" => ['auto - Bollo', 'auto - Assicurazione', 'auto - Gomme', 'auto - Carburante', 'silat - Sporting', 'silat - Mike', 'bollette', 'siti_web', 'mutuo', 'viaggi'],
    "bollette" => ['luce', 'gas', 'acqua', 'spazzatura', 'internet', 'netflix', 'amazon_prime', 'assicurazione_casa', 'alleanza', 'telepass'],
    "stipendio" => ['lordo', 'netto', 'taxes', 'tot_income'],
    "mutuo" => ['amount', 'interests', 'capital'],
];
