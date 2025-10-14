<?php
$datavalues = [];

$data_acqua = $manager->getData("bollette_acqua");

foreach ($data as $d) {
    foreach ($months as $k => $v) {
        if (($d['ref_year'] == $refYear) && ($d['ref_month'] == $v)) {
            foreach ($fields_trasp as $label => $key) {
                if (isset($d["" . $key . ""])) {
                    $datavalues["" . $refYear . ""]["" . $v . ""]["" . $d['name'] . ""]["" . $key . ""] = $d["" . $key . ""];
                }
            }
        }
    }
}

foreach ($data_acqua as $d) {
    foreach ($months as $k => $v) {
        if (($d['ref_year'] == $refYear) && ($d['ref_month'] == $v)) {
            foreach ($fields_trasp as $label => $key) {
                if (isset($d["" . $key . ""])) {
                    $datavalues["" . $refYear . ""]["" . $v . ""]["Acqua"]["" . $key . ""] = $d["" . $key . ""];
                }
            }
            // Calcola prev_read_consumption come il valore di read_consumption del record precedente
            $prev_read_consumption = 0;
            $difference_consumption = 0;
            $prev_read_consumption = 0;
            $monthArr = explode(' ', $datavalues["".$refYear.""]["".$v.""]['Acqua']['read_month']);
            $readMonthVal = $monthArr[0] ?? '';
            $month_value = $months["".$readMonthVal.""] ?? '';
            foreach($datavalues as $year2 => $yearBlock2) {
                foreach ($yearBlock2 as $month2 => $monthBlock2) {
                    if (isset($monthBlock2['Acqua'])) {
                        $monthArr2 = explode(' ', $datavalues["".$year2.""]["".$month2.""]['Acqua']['read_month']);
                        $readMonthVal2 = $monthArr2[0] ?? '';
                        $month_value2 = $months["".$readMonthVal2.""] ?? '';
                        if($month_value > $month_value2) {
                            $prev_read_consumption = $monthBlock2['Acqua']['read_consumption'] ?? 0;
                            $difference_consumption = $datavalues["" . $refYear . ""]["" . $v . ""]["Acqua"]['read_consumption'] - $prev_read_consumption;
                            break;
                        }
                    }
                }
            }
            $unit_cons_amount = round($difference_consumption * ($datavalues["" . $refYear . ""]["" . $v . ""]["Acqua"]["unit_amount"] ?? 0), 2);
            $unit_tot_amount = round($unit_cons_amount + ($datavalues["" . $refYear . ""]["" . $v . ""]["Acqua"]["unit_common_amount"] ?? 0), 2);

            if(
                !$datavalues["" . $refYear . ""]["" . $v . ""]["Acqua"]["difference_consumption"]
                && !$datavalues["" . $refYear . ""]["" . $v . ""]["Acqua"]["unit_cons_amount"]
                && !$datavalues["" . $refYear . ""]["" . $v . ""]["Acqua"]["unit_tot_amount"]
            ){
                try {
                    $manager->updateData('bollette', 'bollette_acqua', $refYear, $v, $difference_consumption, 'Acqua', 'difference_consumption');
                    $manager->updateData('bollette', 'bollette_acqua', $refYear, $v, $unit_cons_amount, 'Acqua', 'unit_cons_amount');
                    $manager->updateData('bollette', 'bollette_acqua', $refYear, $v, $unit_tot_amount, 'Acqua', 'unit_tot_amount');
                } catch (Exception $e) {
                    echo "Error in update: " . $e->getMessage() . "";
                }
            }
        }
    }
}
