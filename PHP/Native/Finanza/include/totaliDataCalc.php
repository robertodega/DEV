<?php
$totFixedOutcomes = [];
$totExtraOutcomes = [];
$totOutcomes = [];
$totNetSalary = [];
$totGrossSalary = [];
$totNet = [];
$saving = [];
$totSavings = [];
$averageSavings = [];
$averageFixedOutcomes = [];
$averageTotOutcomes = [];

$prevRefYear = intval($refYear) - 1;

foreach ($months as $k => $v) {
    $totFixedOutcomes["" . $refYear . ""]["" . $v . ""] = 0;
    $totExtraOutcomes["" . $refYear . ""]["" . $v . ""] = 0;
    $totOutcomes["" . $refYear . ""]["" . $v . ""] = 0;
    $totNet["" . $refYear . ""]["" . $v . ""] = 0;
    $totNet["" . $prevRefYear . ""]["" . $v . ""] = 0;
    $totSavings["" . $refYear . ""]["" . $v . ""] = 0;
}

#   totFixedOutcomes - bollette
$dataMutuo = $manager->getData("mutuo");
foreach ($overviewCategories as $cat => $item) {
    if (is_array($item)) {
        foreach ($item as $i) {
            foreach ($months as $k => $v) {
                $data_value = $datavalues["" . $i . ""]["" . $refYear . ""]["" . $v . ""];
                $totFixedOutcomes["" . $refYear . ""]["" . $v . ""] += is_numeric($data_value) ? (float)$data_value : 0;
            }
        }
    }
}
#   totFixedOutcomes - mutuo
foreach ($dataMutuo as $d) {
    foreach ($months as $k => $v) {
        if (($d['ref_year'] == $refYear) && ($d['ref_month'] == $v)) {
            $totFixedOutcomes["" . $refYear . ""]["" . $v . ""] += $d["amount"] ?? 0;
        }
    }
}
#   totFixedOutcomes - overview
$dataOverview = $manager->getData("overview");
foreach ($dataOverview as $d) {
    foreach ($months as $k => $v) {
        if (($d['ref_year'] == $refYear) && ($d['ref_month'] == $v)) {
            $totFixedOutcomes["" . $refYear . ""]["" . $v . ""] += $d['amount'] ?? 0;
        }
    }
}

#   Salary data
$dataSalary = $manager->getData("stipendio");
foreach ($dataSalary as $d) {
    foreach ($months as $k => $v) {
        if (($d['ref_year'] == $refYear) && ($d['ref_month'] == $v)) {
            $totNetSalary["" . $refYear . ""]["" . $v . ""] += $d['netto'] ?? 0;
            $totGrossSalary["" . $refYear . ""]["" . $v . ""] += $d['netlordoto'] ?? 0;
        }
    }
}

#   Savings data
$dataSaldo = $manager->getData("contocorrente");
foreach ($dataSaldo as $d) {
    foreach ($months as $k => $v) {
        if (($d['ref_year'] == $refYear) && ($d['ref_month'] == $v)) {
            $totNet["" . $refYear . ""]["" . $v . ""] = $d["amount"] ?? 0;
        }
        if (($d['ref_year'] == $prevRefYear) && ($d['ref_month'] == $v)) {
            $totNet["" . $prevRefYear . ""]["" . $v . ""] += $d["amount"] ?? 0;
        }
    }
}
foreach ($months as $k => $v) {
    $prevMonth = intval($v - 1);
    $prevMonth = strlen($prevMonth) == 1 ? "0" . $prevMonth : $prevMonth;
    $refMonth = strlen($v) == 1 ? "0" . $v : $v;
    $curNet = $totNet["" . $refYear . ""]["" . $refMonth . ""];
    $prevNet = $totNet["" . $refYear . ""]["" . $prevMonth . ""];
    if ($v == '01') {
        $prevMonth = 12;
        $prevNet = $totNet["" . $prevRefYear . ""]["" . $prevMonth . ""];
    }
    else{
        $prevNet = $totNet["" . $refYear . ""]["" . $prevMonth . ""] ?? 0;
    }
    $saving["" . $refYear . ""]["" . $refMonth . ""] = floatval($curNet) - floatval($prevNet);
    
    $totExtraOutcomes["" . $refYear . ""]["" . $v . ""] = floatval($prevNet - $totFixedOutcomes["" . $refYear . ""]["" . $v . ""] + $totNetSalary["" . $refYear . ""]["" . $v . ""] - $totNet["" . $refYear . ""]["" . $v . ""]);
    $totOutcomes["" . $refYear . ""]["" . $v . ""] = floatval($totFixedOutcomes["" . $refYear . ""]["" . $v . ""] + $totExtraOutcomes["" . $refYear . ""]["" . $v . ""]);
    #   $totOutcomes["" . $refYear . ""]["" . $v . ""] = $totNetSalary["" . $refYear . ""]["" . $v . ""] ? floatval($prevNet - $curNet - $totNetSalary["" . $refYear . ""]["" . $v . ""]) : floatval($prevNet - $curNet);
    #   $totExtraOutcomes["" . $refYear . ""]["" . $v . ""] = floatval($totOutcomes["" . $refYear . ""]["" . $v . ""] - $totFixedOutcomes["" . $refYear . ""]["" . $v . ""]);

    for ($i = 1; $i <= intval($v); $i++) {
        $totInd = strlen($i) == 1 ? "0" . $i : $i;
        $refMonth = strlen($v) == 1 ? "0" . $v : $v;
        $totSavings["" . $refYear . ""]["" . $refMonth . ""] += $saving["" . $refYear . ""]["" . $totInd . ""];
        $averageSavings["" . $refYear . ""]["" . $refMonth . ""] = round($totSavings["" . $refYear . ""]["" . $refMonth . ""] / $i, 2);

        $sumFixed["" . $refYear . ""]["" . $refMonth . ""] += $totFixedOutcomes["" . $refYear . ""]["" . $totInd . ""];
        $averageFixedOutcomes["" . $refYear . ""]["" . $refMonth . ""] = round($sumFixed["" . $refYear . ""]["" . $refMonth . ""] / $i, 2);

        $sumTotOutcomes["" . $refYear . ""]["" . $refMonth . ""] += $totOutcomes["" . $refYear . ""]["" . $totInd . ""];
        $averageTotOutcomes["" . $refYear . ""]["" . $refMonth . ""] = round($sumTotOutcomes["" . $refYear . ""]["" . $refMonth . ""] / $i, 2);
    }
}

foreach ($totaliCategories as $cat => $item) {
    foreach ($months as $k => $v) {
        $index = str_replace(' ', '_', $cat);
        $datavalues["" . $index . ""]["" . $refYear . ""]["" . $v . ""] = 0;
        switch ($index) {
            case 'Spese_Fisse':
                $datavalues["" . $index . ""]["" . $refYear . ""]["" . $v . ""] = $totFixedOutcomes["" . $refYear . ""]["" . $v . ""];
                break;
            case 'Spese_Extra':
                $datavalues["" . $index . ""]["" . $refYear . ""]["" . $v . ""] = $totExtraOutcomes["" . $refYear . ""]["" . $v . ""];
                break;
            case 'Spese_Totali':
                $datavalues["" . $index . ""]["" . $refYear . ""]["" . $v . ""] = $totOutcomes["" . $refYear . ""]["" . $v . ""];
                break;
            case 'Spesa_fissa_media_mensile':
                $datavalues["" . $index . ""]["" . $refYear . ""]["" . $v . ""] = $averageFixedOutcomes["" . $refYear . ""]["" . $v . ""];
                break;
            case 'Spesa_totale_media_mensile':
                $datavalues["" . $index . ""]["" . $refYear . ""]["" . $v . ""] = $averageTotOutcomes["" . $refYear . ""]["" . $v . ""];
                break;
            case 'Saldo':
                $datavalues["" . $index . ""]["" . $refYear . ""]["" . $v . ""] = $totNet["" . $refYear . ""]["" . $v . ""];
                break;
            case 'Accantonamento':
                $datavalues["" . $index . ""]["" . $refYear . ""]["" . $v . ""] = $saving["" . $refYear . ""]["" . $v . ""];
                break;
            case 'Accantonamento_medio_mensile':
                $datavalues["" . $index . ""]["" . $refYear . ""]["" . $v . ""] = $averageSavings["" . $refYear . ""]["" . $v . ""];
                break;
            default:
                $datavalues["" . $index . ""]["" . $refYear . ""]["" . $v . ""] = 0;
        }
    }
}
