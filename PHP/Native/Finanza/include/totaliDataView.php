<?php
foreach ($totaliCategories as $cat => $item) {
    $editable = "";
    $tabClass = $item . "Tab";
    $editable = "";
    if (in_array($cat, ['Saldo'])) {
        $editable = "editableField";
    }
    ?>
        <tr>
            <td class='sourceTab <?= $tabClass ?>'><?= $cat ?></td>
            <?php
            foreach ($months as $k => $v) {
                $ref = str_replace(' ', '_', "{$cat}_" . $refYear . "_{$v}");
                $refValue = $datavalues["".str_replace(' ', '_', $cat).""]["" . $refYear . ""]["" . $v . ""];
                $refValue = $refValue != 0 ? $refValue : '';

                $evidenceTxtClass = "";
                $calculatedFieldClass = "";

                if (in_array($fields_trasp["" . $cat . ""], ['Spese_Fisse'])) {
                    $evidenceTxtClass = "evidenceTxtOrange";
                }
                if (in_array($fields_trasp["" . $cat . ""], ['Spese_Extra'])) {
                    $evidenceTxtClass = "evidenceTxtNormalOrange";
                }
                if (in_array($fields_trasp["" . $cat . ""], ['Spese_Totali'])) {
                    $evidenceTxtClass = "evidenceTxtRed";
                }
                if (in_array($fields_trasp["" . $cat . ""], ['Saldo'])) {
                    $evidenceTxtClass = "evidenceTxtGreen";
                }
                if (in_array($fields_trasp["" . $cat . ""], ['Accantonamento', 'Accantonamento_medio_mensile'])) {
                    $evidenceTxtClass = "evidenceTxtNormalGreen";
                }
                if (!in_array($cat, ['Saldo'])) {
                    $calculatedFieldClass = "calculatedField";
                }
                if($refValue < 0){
                    $evidenceTxtClass = "evidenceTxtRed";
                }
            ?>
                <td class='valueCell <?= $editable ?> <?= $evidenceTxtClass ?> <?= $calculatedFieldClass ?>' id='<?= $ref ?>' year='<?= $refYear ?>' month='<?= $v ?>' target='contocorrente' tabId='<?= $tabId ?>' column='amount'><?= $refValue ?></td>
            <?php
            }
            ?>
        </tr>
    <?php
}
    ?>