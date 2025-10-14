<?php
$db = new Dbman();
$conn = $db->getConn();
$manager = new Manager($conn);

$currentYear = date('Y');

$backup = $_REQUEST['backup'] ?? '';

$opAction = $_POST['opAction'] ?? '';
$userManagerAction = $_POST['userManagerAction'] ?? '';
$tabId = $_POST['tabId'] ?? 'overview';
$menuItem = $backup ? '' : '';

$target = $_POST['updateTarget'] ?? '';
$tableName = ($target == 'Acqua') ? "bollette_acqua" : $tabId;
if($tabId == 'totali'){$tableName = "contocorrente";}
$refYear = $_POST['refYear'] ?? $currentYear;
$updateYear = $_POST['updateYear'] ?? $refYear;
$refYear = $updateYear ?? $refYear;
$column = $_POST['updateColumn'] ?? 'amount';

if($tabId == 'backupDb') {$opAction = 'backupDb';}

#   echo"<h1>tabId: ".$tabId.", opAction: ".$opAction."</h1>";

if($opAction == 'update'){
    $year = $_POST['updateYear'] ?? '';
    $month = $_POST['updateMonth'] ?? '';
    $value = $_POST['updateValue'] ?? 0;

    #   conversionee data da formato datepicker a yyyy-mm-dd
    if(in_array($column, $datetime_fields)){
        $dateParts = explode('/', $value);
        if(count($dateParts) == 3){
            $value = "{$dateParts[2]}-{$dateParts[1]}-{$dateParts[0]}";
        } else {
            $value = '';
        }
    }

    try {
        $manager->updateData($tabId, $tableName, $year, $month, $value, $target, $column);
    } catch (Exception $e) {
        #   echo "Error in update: " . $e->getMessage() . "";
    }

}
elseif($opAction == 'backupDb'){
    $manager->backupDb(false, true);
}

if ($userManagerAction) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $manager->userManager($userManagerAction, $username, $password);
}

if(!(in_array($tableName, ["salvadanaio"]))){
    $data = $manager->getData("" . $tableName . "");
}