<?php
#   data insert
foreach ($overviewCategories as $cat => $item) {
    $editable = "";
    if (in_array($cat, ['Auto', 'Silat', 'Saldo'])) {
        $editable = "editableField";
    }
    if (is_array($item)) {
        echo "<tr><td class='sourceTab'>" . $cat . "</td></tr>";
        foreach ($item as $i) {
?>
            <tr>
                <td class='valueTab' id='{$i}'><?= $i ?></td>
                <?php
                foreach ($months as $k => $v) {
                    $ref = str_replace(' ', '_', "{$i}_" . $refYear . "_{$v}");
                    $refValue = $datavalues["" . $i . ""]["" . $refYear . ""]["" . $v . ""];
                    $refValue = $refValue != 0 ? $refValue : '';

                    $calculatedFieldClass = '';

                    if (in_array($cat, ['Bollette'])) {
                        $calculatedFieldClass = "calculatedField";
                    }
                ?>
                    <td class='valueCell <?= $editable ?> <?= $calculatedFieldClass ?>' id='<?= $ref ?>' year='<?= $refYear ?>' month='<?= $v ?>' target='<?= $i ?>' tabId='<?= $tabId ?>'><?= $refValue ?></td>
            <?php
                }
            }
            ?>
            </tr>
        <?php
    } else {
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
                    $refValue = $datavalues["" . $cat . ""]["" . $refYear . ""]["" . $v . ""];
                    $refValue = $refValue != 0 ? $refValue : '';

                    $evidenceTxtClass = "";
                    $calculatedFieldClass = '';

                    if (in_array($cat, ['Mutuo'])) {
                        $evidenceTxtClass = "evidenceTxtOrange";
                        $calculatedFieldClass = "calculatedField";
                    }
                ?>
                    <td class='valueCell <?= $editable ?> <?= $evidenceTxtClass ?> <?= $calculatedFieldClass ?>' id='<?= $ref ?>' year='<?= $refYear ?>' month='<?= $v ?>' target='<?= $i ?>'><?= $refValue ?></td>
                <?php
                }
                ?>
            </tr>
    <?php
    }
}
    ?>