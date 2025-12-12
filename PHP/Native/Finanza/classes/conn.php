<?php
$pdo = new Dbman();
$conn = $pdo->getConn();
$manager = new Manager($conn);