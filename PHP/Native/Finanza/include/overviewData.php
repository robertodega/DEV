<div class="hiddenDiv popupDiv" id="updateFormDiv"></div>

<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            <td class='firstTableField'></td>
            <?php
            foreach ($months as $k => $v) {
                echo "<td class='billFieldTab'>{$k}</td>";
            }
            ?>
        </tr>
    </thead>

    <tbody>
        <?php include 'overviewDataView.php'; ?>
    </tbody>
    
</table>