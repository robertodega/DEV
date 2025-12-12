<?php
$p = $_GET['p'] ?? 'totali';
$refYear = $_GET['y'] ?? date('Y');
$m = $_GET['m'] ?? '';

$allowedYears = [];
$startYear = date('Y');
$endYear = $p == "mutuo" ? 2022 : date('Y') - 5;
for ($y = $startYear + 1; $y >= $endYear; $y--) {
    $allowedYears[] = $y;
}

if((!in_array($p, $pageRefs)) || (!in_array($refYear, $allowedYears))){
    header("Location: ./");
}

foreach($tablesList as $key => $table){
    $dataContent[$key] = $manager->getData($table);
}