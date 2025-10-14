<?php include 'mutuoDataCalc.php'; ?>

<div class="hiddenDiv popupDiv" id="updateFormDiv"></div>

<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            <td class='billFieldTab'>Mese</td>
            <?php
            foreach ($mutuoFields as $f) {
                echo "<td class='billFieldTab'>" . $f . "</td>";
            }
            ?>
        </tr>
    </thead>

    <tbody>
        <?php 
            include 'mutuoDataView.php'; 
            include 'mutuoDataTotalView.php'; 
        ?>
    </tbody>

</table>