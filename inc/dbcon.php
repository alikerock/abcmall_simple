<?php
    $hostname = 'localhost';
    $dbuserid = 'alikerock';
    $dbpasswd = 'dejay*!2930';
    $dbname = 'alikerock';

    $mysqli = new mysqli($hostname,$dbuserid, $dbpasswd,$dbname);
    if($mysqli -> connect_errno){
        die('Connect Error:'.$mysqli->connect_error);
    }
?>