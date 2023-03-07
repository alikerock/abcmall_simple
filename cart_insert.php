<?php
    session_start();
    ini_set('display_errors',1);

    include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

    $pid = $_POST['pid'];
    $opts =  $_POST['opts'];
    $cnt =  $_POST['cnt'];
    $ssid = session_id();
    $userid = $_SESSION['UID'];

