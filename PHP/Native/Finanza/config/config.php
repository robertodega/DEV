<?php
define("DB_HOST", "localhost");
define("DB_HOST_N", "127.0.0.1");
define("DB_NAME", "finanza");
define("LOGIN_TABLE_NAME", "loggedusers");
define("DB_USER", "root");
define("DB_PWD", "");

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

define("MUTUO_START_YEAR", 2022);

$months = [
    'Gennaio' => '01',
    'Febbraio' => '02',
    'Marzo' => '03',
    'Aprile' => '04',
    'Maggio' => '05',
    'Giugno' => '06',
    'Luglio' => '07',
    'Agosto' => '08',
    'Settembre' => '09',
    'Ottobre' => '10',
    'Novembre' => '11',
    'Dicembre' => '12'
];

$overviewCategories = [
    'Auto' => [
        'Bollo'
        , 'Assicurazione'
        , 'Gomme'
        , 'Carburante'
    ],
    'Silat' => [
        'Sporting',
        'Mike'
    ],
    'Bollette' => [
        'Luce'
        , 'Gas'
        , 'Acqua'
        , 'Spazzatura'
        , 'Internet'
        , 'Netflix'
        , 'Amazon Prime'
        , 'Unipol Assicurazioni'
        , 'Alleanza'
        , 'Telepass'
        , 'Siti web'
    ],
    'Mutuo' => 'source',
];

$totaliCategories = [
    'Spese Fisse' => 'tot'
    , 'Spese Extra' => 'tot'
    , 'Spese Totali' => 'totRed'
    , 'Spesa fissa media mensile' => 'stat'
    , 'Spesa totale media mensile' => 'stat'
    , 'Saldo' => 'green'
    , 'Accantonamento' => 'net'
    , 'Accantonamento medio mensile' => 'net'
];

$stipendioCategories = [
    'Lordo' => 'net'
    , 'Netto' => 'net'
    , 'Tasse' => 'stat'
    , 'Tickets_forniti' => 'net'
    , 'Tickets_value' => 'net'
    , 'Tickets_amount' => 'green'
    , 'Tot_introiti' => 'green'
];

$mutuoFields = [
    'Data Pagamento', 'Quota Pagata', 'Interessi', 'Capitale Rimborsato'
];

$billFields = [
    'common' => ['Mese', 'Data pagamento', 'Spesa', 'Periodo di riferimento', 'Note']
    , 'complete' => ['Mese', 'Data pagamento', 'Spesa', 'Periodo di riferimento', 'Consumo', 'Costo unitario', 'Note']
    , 'Acqua' => ['Mese', 'Consumo totale fatturato (m<sup>3</sup>)', 'Periodo di riferimento', 'Data pagamento', 'Costo Consumi (Acquedotto)', 'Costo TOT bolletta', 'Data fattura', 'Mese Lettura', 'Lettura (m<sup>3</sup>)', 'Consumo effettivo (m<sup>3</sup>)', 'Costi comuni', 'Costo / m<sup>3</sup>', 'Costi comuni unitari', 'Costo consumi unitari', 'Costo totale unitario']
];

$fields_trasp = [
    #   Bollette
    'Data pagamento' => 'payment_date'
    , 'Spesa' => 'amount'
    , 'Periodo di riferimento' => 'referral_period'
    , 'Consumo' => 'consumption'
    , 'Costo unitario' => 'unit_cost'
    , 'Note' => 'note'
    , 'Consumo totale fatturato (m<sup>3</sup>)' => 'tot_consumption'
    , 'Costo Consumi (Acquedotto)' => 'cons_amount'
    , 'Costi comuni' => 'common_amount'
    , 'Costo TOT bolletta' => 'tot_amount'
    , 'Costo / m<sup>3</sup>' => 'unit_amount'
    , 'Data fattura' => 'bill_date' 
    , 'Mese Lettura' => 'read_month'
    , 'Lettura (m<sup>3</sup>)' => 'read_consumption'
    , 'Consumo effettivo (m<sup>3</sup>)' => 'difference_consumption'
    , 'Costi comuni unitari' => 'unit_common_amount'
    , 'Costo consumi unitari' => 'unit_cons_amount'
    , 'Costo totale unitario' => 'unit_tot_amount'
    #   Stipendio
    , 'Lordo' => 'lordo'
    , 'Netto' => 'netto'
    , 'Tickets_value' => 'ticket_value'
    , 'Tickets_forniti' => 'ticket_n'
    #   Mutuo
    , 'Data Pagamento' => 'payment_date'
    , 'Quota Pagata' => 'amount'
    , 'Interessi' => 'interests'
    , 'Capitale Rimborsato' => 'capital'
    #   Totali
    , 'Spese Fisse' => 'Spese_Fisse'
    , 'Spese Extra' => 'Spese_Extra'
    , 'Spese Totali' => 'Spese_Totali'
    , 'Saldo' => 'Saldo'
    , 'Spesa fissa media mensile' => 'Spesa_fissa_media_mensile'
    , 'Spesa totale media mensile' => 'Spesa_totale_media_mensile'
    , 'Accantonamento' => 'Accantonamento'
    , 'Accantonamento medio mensile' => 'Accantonamento_medio_mensile'
];

$datetime_fields = [
    'payment_date' => 'Data pagamento'
    , 'bill_date' => 'Data fattura'
];

$titleRefList = [
    "difference_consumption" => "Lettura corrente - Lettura precedente"
    , "common_amount" => "Costo TOT bolletta - Costo Consumi (Acquedotto)"
    , "unit_amount" => "Costo Consumi (Acquedotto) / Consumo totale fatturato"
    , "unit_common_amount" => "Costi comuni / 3"
    , "unit_cons_amount" => "Consumo effettivo  * Costo / m3"
    , "unit_tot_amount" => "Costo consumi unitari + Costi comuni unitari"
];