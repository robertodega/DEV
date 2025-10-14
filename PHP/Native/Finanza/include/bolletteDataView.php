<?php
foreach ($overviewCategories["Bollette"] as $b) {
    $refColumnsList = ($b == 'Acqua') ? $billFields['Acqua'] : $billFields['common'];
    if (in_array($b, ['Luce', 'Gas'])) {
        $refColumnsList = $billFields['complete'];
    }
?>
    <button class="accordion" id="accordion_<?= $b ?>"><?= $b ?></button>
    <div class="panel">
        <table class='table table-striped table-bordered'>
            <tr>
                <?php
                foreach ($refColumnsList as $c) {
                    $calculatedFieldHead = "";
                    if (in_array($c, ['Consumo effettivo (m<sup>3</sup>)', 'Costi comuni', 'Costo / m<sup>3</sup>', 'Costi comuni unitari', 'Costo consumi unitari', 'Costo totale unitario'])) {
                        $calculatedFieldHead = "calculatedFieldHead";
                    }
                ?>
                    <td class='billFieldTab <?= $calculatedFieldHead ?>'><?= $c ?></td>
                <?php
                }
                ?>
            </tr>
            <?php
            foreach ($months as $k => $v) {
            ?>
                <tr>
                    <td class='valueCell'><?= $k ?></td>
                    <?php
                    foreach ($refColumnsList as $c) {
                        $totalField = "";
                        if ($c != 'Mese') {
                            $cellvalue = $datavalues["" . $refYear . ""]["" . $v . ""]["" . $b . ""][$fields_trasp[$c]];
                            $editable = "editableField";
                            $titleRef = "";
                            if ($b == 'Acqua') {
                                #   if (in_array($c, ['Consumo effettivo (m<sup>3</sup>)', 'Costi comuni', 'Costo / m<sup>3</sup>', 'Costi comuni unitari', 'Costo consumi unitari', 'Costo totale unitario'])) {
                                if (in_array($c, ['Consumo effettivo (m<sup>3</sup>)', 'Costi comuni', 'Costo / m<sup>3</sup>', 'Costi comuni unitari', 'Costo consumi unitari'])) {
                                    $editable = "calculatedField";
                                    $titleRef = $titleRefList["" . $fields_trasp["" . $c . ""]] ?? "Calcolo automatico del campo";
                                }
                            }
                            if ((in_array($c, ['Costo totale unitario', 'Spesa'])) && $cellvalue) {
                                $totalField = "totalField";
                            }
                            $cellvalue = $cellvalue != 0 ? $cellvalue : '';

                            if (in_array($c, $datetime_fields)) {
                                $datepickerPresent = $cellvalue ? "datepickerPresent" : "datepickerAbsent";
                                $cellvalue = "<input type='date' class='form-control datepicker " . $datepickerPresent . " datepickerCell' id='datepicker_" . $refYear . "_" . $v . "_" . $c . "' year='" . $refYear . "' month='" . $v . "' target='" . $b . "' tabId='" . $tabId . "' column='" . $fields_trasp[$c] . "' value='" . htmlspecialchars($cellvalue) . "' />";
                            }

                            if (in_array($fields_trasp[$c], ['amount', 'tot_amount', 'unit_cost'])) {
                                $cellvalue = "<span class='evidenceTxt'>" . htmlspecialchars($cellvalue) . "</span>";
                            }

                    ?>
                            <td class='valueCell <?= $editable ?> <?= $totalField ?>' titleRef='<?= $titleRef ?>' id='col_<?= $fields_trasp[$c] ?>_<?= $refYear ?>_<?= $k ?>' year='<?= $refYear ?>' month='<?= $v ?>' target='<?= $b ?>' tabId='<?= $tabId ?>' column='<?= $fields_trasp[$c] ?>'>
                                <?= $cellvalue ?>
                            </td>
                    <?php
                        }
                    }
                    ?>
                </tr>
            <?php } ?>
        </table>
    </div>
<?php
}
?>