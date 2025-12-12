<?php
    include __DIR__ . "/header.inc.php";
    include __DIR__ . "/content.inc.php";
    if(!in_array($p, ["backup"])){include __DIR__ . "/charts.inc.php";}
