<?php
    include_once 'classes/dbman.php';
    include_once 'classes/manager.php';

    $db = new Dbman();
    $conn = $db->getConn();
    $manager = new Manager($conn);
?>