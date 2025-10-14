<?php
$datavalues = [];

$data = $manager->getData("stipendio");

foreach ($data as $d) {
    foreach ($months as $k => $v) {
        if (($d['ref_year'] == $refYear) && ($d['ref_month'] == $v)) {
            $datavalues["" . $refYear . ""]["" . $v . ""]["Lordo"] = $d["lordo"] ?? '';
            $datavalues["" . $refYear . ""]["" . $v . ""]["Netto"] = $d["netto"] ?? '';
            $datavalues["" . $refYear . ""]["" . $v . ""]["Tickets_forniti"] = $d["ticket_n"] ?? '';
            $datavalues["" . $refYear . ""]["" . $v . ""]["Tasse"] = ($d["lordo"] && $d["netto"]) ? round((100-(($d["netto"]/$d["lordo"])*100)), 2) : 0;
            $datavalues["" . $refYear . ""]["" . $v . ""]["Tickets_amount"] = ($d["ticket_value"] && $d["ticket_n"]) ? $d["ticket_value"] * $d["ticket_n"] : 0;
            $datavalues["" . $refYear . ""]["" . $v . ""]["Tickets_value"] = $d["ticket_value"] ?? 0;
            $datavalues["" . $refYear . ""]["" . $v . ""]["Tot_introiti"] = $d["netto"] + $datavalues["" . $refYear . ""]["" . $v . ""]["Tickets_amount"];
        }
    }
}
