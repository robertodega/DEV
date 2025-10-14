<?php
session_start();
include 'config/config.php';
$logout = $_POST["logoutAction"] ?? '';
if ($logout) {
    include INCLUDE_PATH . 'logout.php';
}
#   $bodyClass = !$_SESSION['username'] ? "loginBody" : "";     #   under login
?>
<html>

<head>
    <title>Finanza</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="<?= JS_PATH ?>jquery.js"></script>
    <link rel="stylesheet" href="<?= CSS_PATH ?>bootstrap.css">
    <script src="<?= JS_PATH ?>bootstrap.js"></script>

    <link rel="icon" type="image/x-icon" href="<?= IMG_PATH ?>favicon.ico" />
    <link rel="stylesheet" href="<?= CSS_PATH ?>custom.css">
</head>

<body class='<?= $bodyClass ?>'>
    <?php
    #   include isset($_SESSION['username']) ? INCLUDE_PATH . 'contentDiv.php' : INCLUDE_PATH . 'login.php';    #   under login
    include INCLUDE_PATH . 'contentDiv.php';
    ?>
    <div class="clearDiv"></div>

</body>

</html>

<script src="<?= JS_PATH ?>custom.js"></script>