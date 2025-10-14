<?php
$datavalues = [];

$hiddenColumns = ['id', 'created_at', 'updated_at'];

#   Overview data
foreach ($data as $d) {
    $refMonth = $d['ref_month'] ?? '';
    $refMonth = strlen($refMonth) == 1 ? "0" . $refMonth : $refMonth;
    foreach ($d as $key => $value) {
        if (in_array($key, $hiddenColumns)) {
            continue;
        }
        $datavalues["" . $d['name'] . ""]["" . $d['ref_year'] . ""]["" . $refMonth . ""] = $d['amount'];
    }
}

#   Bollette data
$dataBollette = $manager->getData("bollette");
foreach ($dataBollette as $d) {
    $refMonth = $d['ref_month'] ?? '';
    $refMonth = strlen($refMonth) == 1 ? "0" . $refMonth : $refMonth;
    $datavalues["" . $d['name'] . ""]["" . $d['ref_year'] . ""]["" . $refMonth . ""] = $d['amount'];
}

#   Bollette acqua data
$data_acqua = $manager->getData("bollette_acqua");
foreach ($data_acqua as $d) {
    $refMonth = $d['ref_month'] ?? '';
    $refMonth = strlen($refMonth) == 1 ? "0" . $refMonth : $refMonth;
    $datavalues["Acqua"]["" . $d['ref_year'] . ""]["" . $refMonth . ""] = $d['unit_tot_amount'];
}

#   Mutuo data
$dataMutuo = $manager->getData("mutuo");
foreach ($dataMutuo as $d) {
    $year = $d['ref_year'] ?? '';
    $month = $d['ref_month'] ?? '';
    $month = strlen($month) == 1 ? "0" . $month : $month;
    $amount = $d['amount'] ?? '';
    foreach ($months as $k => $v) {
        $datavalues["Mutuo"]["" . $year . ""]["" . $month . ""] = $amount;
    }
}

