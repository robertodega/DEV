<?php
$datavalues = [];

$data = $manager->getData("mutuo");

$totYearPayments = 0;
$totYearInterests = 0;
$totYearCapital = 0;
$totPayments = 0;
$totInterests = 0;
$totCapital = 0;

foreach ($data as $d) {
    foreach ($months as $k => $v) {
        if (($d['ref_year'] == $refYear) && ($d['ref_month'] == $v)) {
            foreach ($mutuoFields as $item) {
                $datavalues["" . $refYear . ""]["" . $v . ""]["" . $fields_trasp["".$item.""] . ""] = $d["" . $fields_trasp["".$item.""] . ""] ?? '';
            }
            $totYearPayments += $datavalues["" . $refYear . ""]["" . $v . ""]["amount"] ?? 0;
            $totYearInterests += $datavalues["" . $refYear . ""]["" . $v . ""]["interests"] ?? 0;
            $totYearCapital += $datavalues["" . $refYear . ""]["" . $v . ""]["capital"] ?? 0;
        }
    }
    $totPayments += $d["amount"] ?? 0;
    $totInterests += $d["interests"] ?? 0;
    $totCapital += $d["capital"] ?? 0;
}
