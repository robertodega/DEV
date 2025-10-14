<?php

$refColumnsList = $mutuoFields;
foreach ($months as $k => $v) {
    $mutuoDoc = MUTUO_DOCS_PATH.$refYear."/" . $refYear . "_" . $v . ".pdf";
    if (!file_exists($mutuoDoc)) {
        $mutuoDoc = IMG_PATH."404.png";
    }
?>
    <tr>
        <td class='valueCell'><a title='Open rata <?= $mutuoDoc ?>' href='<?= $mutuoDoc ?>' target='_blank'><?= $k ?></a></td>
        <?php
        foreach ($refColumnsList as $c) {
            $ref = str_replace(' ', '_', "{$c}_" . $refYear . "_{$v}");
            $totalField = "";
            $cellvalue = "";
            $cellvalue = $datavalues["" . $refYear . ""]["" . $v . ""]["" . $fields_trasp["" . $c . ""] . ""];
            $editable = "editableField";
            $cellvalue = $cellvalue != 0 ? $cellvalue : '';

            if (in_array($fields_trasp["" . $c . ""], ['payment_date'])) {
                $datepickerPresent = $cellvalue ? "datepickerPresent" : "datepickerAbsent";
                $cellvalue = "<input type='date' class='form-control datepicker " . $datepickerPresent . " datepickerCell' id='datepicker_" . $refYear . "_" . $v . "_" . $c . "' year='" . $refYear . "' month='" . $v . "' target='mutuo' tabId='" . $tabId . "' column='" . $fields_trasp[$c] . "' value='" . htmlspecialchars($cellvalue) . "' />";
            }

            $evidenceTxtClass = "";
            if (in_array($fields_trasp["" . $c . ""], ['amount'])) {
                $evidenceTxtClass = "evidenceTxt";
            }
            if (in_array($fields_trasp["" . $c . ""], ['interests'])) {
                $evidenceTxtClass = "evidenceTxtRed";
            }
            if (in_array($fields_trasp["" . $c . ""], ['capital'])) {
                $evidenceTxtClass = "evidenceTxtGreen";
            }
        ?>
            <td class='valueCell <?= $editable ?> <?= $evidenceTxtClass ?>' id='<?= $ref ?>' year='<?= $refYear ?>' month='<?= $v ?>' target='mutuo' tabId='<?= $tabId ?>' column='<?= $fields_trasp[$c] ?>'>
                <?= $cellvalue ?>
            </td>
        <?php
        }
        ?>
    </tr>
<?php
}
?>