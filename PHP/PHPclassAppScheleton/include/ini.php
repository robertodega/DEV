<?php
    #	session_start();

    include 'const.php';
    include 'projClass.php';

    $instance = new projClass();
    $conn = $instance->connect();

