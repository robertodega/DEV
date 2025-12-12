<?php
$opAct = $_POST["opAct"] ?? "";
$column = $_POST["updateColumn"] ?? "";
$name = "";

if ($opAct == 'update') {
    $year = $_POST['updateYear'] ?? '';
    $month = $_POST['updateMonth'] ?? '';
    $value = $_POST['updateValue'] ?? 0;

    $updateTable = $_POST['updateTable'] ?? '';
    if(in_array($updateTable, ["overview", "bills"])){
        $name = $column;
        $column = "amount";
    }

    #   conversionee data da formato datepicker a yyyy-mm-dd
    if (in_array($column, $datetime_fields)) {
        $dateParts = explode('/', $value);
        if (count($dateParts) == 3) {
            $value = "{$dateParts[2]}-{$dateParts[1]}-{$dateParts[0]}";
        } else {
            $value = '';
        }
    }

    try {
        $manager->updateData($year, $month, $updateTable, $column, $value, $name);
        header("Location: ./?y=".$year."&p=".$p."");
    } catch (Exception $e) {
        // echo "Error in update: " . $e->getMessage() . "";
    }
}
