<div class="card-body">
    <div class="graph-box graph-period-div">
        <div class="graph-period-div">
            <?= $refYear ?>
            <select class="form-select graph-selector" id="monthSelector" name="monthSelector" onchange="document.location.href='./?y=<?= $refYear ?>&month='+this.value+'&p=<?= $p ?>&gtype=<?= $gtype ?>'">
                <?php foreach ($months as $k => $m): ?>
                    <option value="<?= $m ?>" <?= ($graphMonth == $m) ? 'selected' : '' ?>><?= $k ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="graph-period-div">
            <select class="form-select graph-selector" id="chartTypeSelector" name="chartTypeSelector" onchange="document.location.href='./?y=<?= $refYear ?>&month='+<?= $graphMonth ?>+'&p=<?= $p ?>&gtype=' + this.value">
                <option value="Pie" <?= ($gtype == "Pie") ? 'selected' : '' ?>>Pie</option>
                <option value="Bar" <?= ($gtype == "Bar") ? 'selected' : '' ?>>Bar</option>
                <option value="Area" <?= ($gtype == "Area") ? 'selected' : '' ?>>Area</option>
            </select>
        </div>
    </div>
    <div class="graph-box graph-img-div">
        <canvas id="my<?= $gtype ?>Chart" width="100%" height="20"></canvas>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script>
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    const labelsContent = <?= json_encode(str_replace("_", " ", $graphAllowedTags[$p])) ?>;
    const graphType = "<?= $gtype ?>";
    <?php
    if (!empty($refYear)) {
    ?>const refYear = <?= json_encode($refYear) ?>;
    <?php
    }
    if (!empty($graphMonth)) {
    ?>const refMonth = <?= json_encode($graphMonth) ?>;
    <?php
    }
    if (!in_array($tablesList[$p], $verticalMonthsPages)) {
    ?>const dataContent = <?= json_encode($dataSet) ?>;
    <?php
    } else {
    ?>const dataContent = <?= json_encode($dataSetVertical) ?>;
    <?php
    }
    ?>
    let dataContentJson = JSON.stringify(dataContent, null, 2);
    let dataContentParse = JSON.parse(dataContentJson);
    let dataGraph = [];
    <?php
    foreach ($graphAllowedTags[$p] as $tag) {
        if (!in_array($tablesList[$p], $verticalMonthsPages)) {
    ?>
            if (dataContentParse[refYear][refMonth].hasOwnProperty('<?= ucfirst($tag) ?>')) {
                dataGraph.push(dataContentParse[refYear][refMonth]['<?= ucfirst($tag) ?>']);
            }
            else{
                dataGraph.push(0);
            }
    <?php
        } else {
        ?>dataGraph.push(dataContentParse[refYear][refMonth]['<?= $tag ?>']);
    <?php
        }
    } 
    ?>
    let maxDataValue = Math.max(...dataGraph);
    var ctx = document.getElementById("my" + graphType + "Chart");
</script>
<script src="<?= JS_PATH ?>graphs.js"></script>