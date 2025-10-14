<?php
foreach ($stipendioCategories as $cat => $item) {
    $editable = "";
    $tabClass = $item . "Tab";
    $editable = "";
    if (in_array($cat, ['Netto', 'Lordo', 'Tickets_forniti', 'Tickets_value'])) {
        $editable = "editableField";
    }
?>
    <tr>
        <td class='sourceTab <?= $tabClass ?>'><?= str_replace('_', ' ', $cat) ?></td>
        <?php
        foreach ($months as $k => $v) {
            $ref = str_replace(' ', '_', "{$cat}_" . $refYear . "_{$v}");
            $refValue = $datavalues["" . $refYear . ""]["" . $v . ""]["" . $cat . ""];
            $refValue = $refValue != 0 ? $refValue : '';
            $evidenceTxtClass = "";
            $calculatedFieldClass = "";
            if (in_array($cat, ['Netto', 'Tickets_amount', 'Tot_introiti'])) {
                $evidenceTxtClass = "evidenceTxt";
            }
            if (in_array($cat, ['Tasse', 'Tickets_amount', 'Tot_introiti'])) {
                $calculatedFieldClass = "calculatedField";
            }
        ?>
            <td class='valueCell <?= $editable ?> <?= $evidenceTxtClass ?> <?= $calculatedFieldClass ?>' id='<?= $ref ?>' year='<?= $refYear ?>' month='<?= $v ?>' target = 'stipendio' tabId='<?= $tabId ?>' column='<?= $fields_trasp[$cat] ?>'>
                <?= $refValue ?>
            </td>
            
        <?php
        }
        ?>
    </tr>
<?php
}
?>