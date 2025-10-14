<?php
include 'classes/dbman.php';
include 'classes/manager.php';
include 'postActions.php';
include 'overviewDataCalc.php';
$bckContent = $manager->scanContentDir(DB_PATH);
?>

<div class="headerDiv">
    <div class="headerBlockDiv">
        <div class="headerTitleDiv" id="headerPathDiv">
            <h2><a href='<?= ROOT_PATH ?>'>Finanza</a> - <?= ucfirst($tabId) ?></h2>
        </div>
        <div class="headerTitleDiv" id="headerYearFormDiv">
            <select class="form-select form-select-sm" id="overviewYearSelect" aria-label=".form-select-sm example">
                <option value="<?= $currentYear ?>" <?= ($refYear == $currentYear) ? 'selected' : '' ?>><?= $currentYear ?></option>
                <?php
                if ($tabId == 'mutuo') {
                    for ($y = $currentYear - 1; $y >= MUTUO_START_YEAR; $y--) {
                        echo "<option value='{$y}' " . (($refYear == $y) ? 'selected' : '') . ">{$y}</option>";
                    }
                } else {
                ?>
                    <option value="<?= $currentYear - 1 ?>" <?= ($refYear == ($currentYear - 1)) ? 'selected' : '' ?>><?= $currentYear - 1 ?></option>
                    <option value="<?= $currentYear - 2 ?>" <?= ($refYear == ($currentYear - 2)) ? 'selected' : '' ?>><?= $currentYear - 2 ?></option>
                <?php
                }
                ?>
            </select>
        </div>
    </div>
    
    <div class='registerFormDiv hiddenDiv' id='registerFormDiv'>
        <span class="registrationTitleSpan"><h1>Registration Utility</h1></span>
        <div class='' id='registrationFormDiv'>
            <form name="userManagerForm" id='userManagerForm' action="<?= ROOT_PATH ?>" method="POST">
                <input type="hidden" name="userManagerAction" id="userManagerAction" value="">
                <input class='form-control registerField' type="text" name="username" id="username" placeholder="Username" required>
                <input class='form-control registerField' type="password" name="password" id="password" placeholder="Password" required>
                <button class='btn btn-secondary registerField registerBtn' type="button" id='registerActBtn' actionRef='register'>Register</button>
                <button class='btn btn-secondary registerField registerBtn' type="button" id='registerUndoBtn'>Close</button>
            </form>
        </div>
    </div>

    <div class="headerBlockDiv headerFormDiv">
        <button type="button" class="btn btn-primary btn-sm menuButton" ref='overview' id="overviewButton"">Overview</button>
        <button type=" button" class="btn btn-primary btn-sm menuButton" ref='totali' id="overviewButton"">Totali</button>
        <button type=" button" class="btn btn-primary btn-sm menuButton" ref='bollette' id="bolletteButton">Bollette</button>
        <button type="button" class="btn btn-primary btn-sm menuButton" ref='stipendio' id="stipendioButton">Stipendio</button>
        <button type="button" class="btn btn-primary btn-sm menuButton" ref='mutuo' id="mutuoButton">Mutuo</button>
        <?php /* TO FIX * ?><button type="button" class="btn btn-primary btn-sm menuButton" ref='salvadanaio' id="salvadanaioButton">Salvadanaio</button><?php /* */ ?>
        <button type="button" class="btn btn-secondary btn-sm menuButton" id="backupDbButton" ref='backupDb'>DB backup</button>
        <?php /* under login * ?>
        <button type="submit" class="btn btn-dark btn-sm logoutButton" id="logoutButton" ref='logout'>Logout</button>
        <button type="button" class='btn btn-dark btn-sm registerBtn' id='registerBtn'>Register</button>
        <?php /* */ ?>
    </div>

    <div class="clearDiv"></div>
</div>

<form class="financeForm" id="financeForm" method="POST" action="<?= ROOT_PATH ?>">
    <input type="hidden" name="tabId" id="tabId" value="<?= $tabId ?>">
    <input type="hidden" name="refYear" id="refYear" value="<?= $refYear ?>">
    <input type="hidden" name="logoutAction" id="logoutAction" placeholder="logoutAction" value="">
</form>

<div class="mainContentDiv" id="mainContentDiv">
    <?php
    include $backup ? INCLUDE_PATH . 'bck.php' : INCLUDE_PATH . $tabId . 'Data.php';
    ?>
</div>

<?php include INCLUDE_PATH . "formField.php"; ?>