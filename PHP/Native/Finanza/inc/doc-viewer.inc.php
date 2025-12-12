<?php
include __DIR__ . "/../config/config.php";

$pageRef = $_POST["pageRef"] ?? "";
$docFolder = $_POST["docFolder"] ?? "";
$refYear = $_POST["refYear"] ?? "";
$refMonth = $_POST["refMonth"] ?? "";
if(strlen($refMonth) == 1){$refMonth = "0".$refMonth;}

$pdfPath = $docFolder.$refYear."/".$refYear."_".$refMonth.".pdf";
if(file_exists(".".$pdfPath)){
    ?><embed src="<?= $pdfPath ?>" type="application/pdf" width="100%" height="100%" /><?php
} else {
    include __DIR__ . "/404.inc.php";
}
