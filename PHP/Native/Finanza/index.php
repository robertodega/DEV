<?php
require_once __DIR__ . "/config/config.php";
require_once __DIR__ . "/inc/functions.inc.php";
require_once __DIR__ . "/classes/dbman.php";
require_once __DIR__ . "/classes/manager.php";
require_once __DIR__ . "/classes/conn.php";

include __DIR__ . "/inc/parameters.inc.php";

?>
<html>

<head>
    <title><?= WEBSITE_TITLE ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="<?= JS_PATH ?>jquery.js"></script>
    <link rel="stylesheet" href="<?= CSS_PATH ?>bootstrap.css">
    <script src="<?= JS_PATH ?>bootstrap.js"></script>

    <link rel="icon" type="image/x-icon" href="<?= IMG_PATH ?>favicon.ico" />
    <link rel="stylesheet" href="<?= CSS_PATH ?>custom.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>graphs.css">
</head>

<body>

</body>
    <?php include __DIR__ . "/inc/content-container.inc.php"; ?>
</html>

<script src="<?= JS_PATH ?>custom.js"></script>