<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/libs/Smarty.class.php';

include_once __DIR__ . '/config/config.php';
include_once __DIR__ . '/include/classConn.php';
include_once __DIR__ . '/include/dataTable.php';

$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/templates/');
$smarty->setCompileDir(__DIR__ . '/templates_c/');

$smarty->assign('rootPath', ROOT_PATH);
$smarty->assign('cssPath', CSS_PATH);
$smarty->assign('jsPath', JS_PATH);
$smarty->assign('imgPath', IMG_PATH);
$smarty->assign('appTitle', APP_TITLE);
$smarty->assign('resultTable', $resultTable);

$smarty->display('home.tpl');
?>