<?php include 'salvadanaioDataCalc.php'; ?>

<div class="hiddenDiv popupDiv" id="updateFormDiv"></div>

<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            <td class='billFieldTab'>Mese</td>
            <td class='billFieldTab'>Accantonamento</td>
            <td class='billFieldTab'>Ammontare</td>
            <?php
            foreach ($months as $k => $v) {
            ?>
        <tr>
            <td class='valueCell'>
                <?= $k ?>
                <?php
                $weeksInMonth = (int)ceil(date('t', strtotime(date('Y') . '-' . $v . '-01')) / 7);
                for ($i = 1; $i <= $weeksInMonth; $i++) {
                ?>
                    <table>
                        <tr>
                            <td>Week <?= $i ?></td>
                        </tr>
                    </table>
                <?php
                }
                ?>
            </td>
            <td class='valueCell'>
                <?php
                for ($i = 1; $i <= $weeksInMonth; $i++) { ?>
                    <table>
                        <tr>
                            <td><?= $saving["" . $v . ""] ?></td>
                        </tr>
                    </table>
                <?php
                }
                ?>
            </td>
            <td class='valueCell'>
                <?php
                for ($i = 1; $i <= $weeksInMonth; $i++) { ?>
                    <table>
                        <tr>
                            <td><?= $amount["" . $v . ""] ?></td>
                        </tr>
                    </table>
                <?php
                }
                ?>
            </td>
        <?php
            }
        ?>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td class='totalField'>Totale Anno</td>
            <td class='totalField calculatedField evidenceTxt'><?= array_sum($saving) ?></td>
            <td class='totalField calculatedField evidenceTxtGreen'><?= array_sum($amount) ?></td>
        </tr>
    </tbody>

</table>