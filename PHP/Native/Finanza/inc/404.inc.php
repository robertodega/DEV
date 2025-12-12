<?php
require_once __DIR__ . "/../config/config.php";
?>
<!DOCTYPE html>
<html>

<head>
  <title><?= DOCNOTFOUND_TITLE ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="<?= IMG_PATH ?>favicon.ico" />
  <link rel="stylesheet" href="<?= CSS_PATH ?>notfound.css">
  <link rel="stylesheet" href="<?= CSS_PATH ?>custom.css">
</head>

<body class="rails-default-error-page">
  <div class="dialog">
    <div>
      <h1><?= DOCNOTFOUND_MSG ?></h1>
      <img class="notfoundimg" src="<?= IMG_PATH ?>404.png" />
      <p><?= DOCNOTFOUND_MSG_2 ?></p>
    </div>
    <p><a href="./?y=<?= $refYear ?>&p=<?= $pageRef ?>">&lt;&lt;&nbsp;Back</a></p>
  </div>
</body>

</html>