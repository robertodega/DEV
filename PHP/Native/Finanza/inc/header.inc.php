<div class="headerDiv">

    <div class="headerBlockDiv">
        <div class="headerTitleDiv" id="headerPathDiv">
            <h2><a href='<?= ROOT_PATH ?>'>Finanza</a> - <?= ucfirst($p) ?></h2>
        </div>
        <div class="headerTitleDiv" id="headerYearFormDiv">
            <select class="form-select form-select-sm locSelector" id="yearSelector" pageRef="<?= $p ?>" aria-label=".form-select-sm example">
                <?php foreach($allowedYears as $y): ?>
                    <option value="<?= $y ?>" <?= ($refYear == $y) ? 'selected' : '' ?>><?= $y ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="headerBlockDiv headerFormDiv">
        <?php 
        $highlightBkp = $p === "backup" ? "highlight" : "";
        foreach ($menuTags as $tag){
            $highlight = $tag === $p ? "highlight" : "";
        ?>
            <button type=" button" class="btn btn-primary btn-sm menuButton locBtn <?= $highlight ?>" pageRef='<?= $tag ?>' refYear='<?= $refYear ?>' id="<?= $tag ?>Button"><?= ucfirst($tag) ?></button>
        <?php } ?>
            <button type="button" class="btn btn-secondary btn-sm menuButton bckBtn <?= $highlightBkp ?>" id="backupDbButton">DB backup</button>
    </div>

</div>