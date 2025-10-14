<?php include 'bolletteDataCalc.php'; ?>

<div class="hiddenDiv popupDiv" id="updateFormDiv"></div>

<div class="billContentDiv" id="billContentDiv">
    <?php include 'bolletteDataView.php'; ?>
</div>

<script>
    $('#accordion_<?= $target ?>').addClass('active');
    var panel = $('#accordion_<?= $target ?>').next();
    panel.css("display", "block");
</script>