<?php
session_start();
ini_set('display_errors',1);

include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

$pid = $_POST['pid'];
$opts =  $_POST['opts'];
$cnt =  $_POST['cnt'];
$ssid = session_id();
$userid = $_SESSION['UID'];

$query = "SELECT cartid from cart where ssid='".$ssid."' and pid = '".$pid."'";
$result = $mysqli ->query($query) or die("query error =>".$mysqli_error);

$rs = $result -> fetch_object();
if($rs->cartid){
    $sql = "UPDATE cart set cnt='".$cnt."', options='".$opts."' where ssid='".$ssid."' and pid = '".$pid."'";
    $result = $mysqli ->query($sql) or die("query error =>".$mysqli_error);
} else{
    $sql = "INSERT INTO  `cart`
    (`pid`,
    `userid`,
    `ssid`,
    `options`,
    `cnt`,
    `regdate`)
    VALUES
    ('".$pid."',
    '".$userid."',
    '".$ssid."',
    '".$opts."',
    '".$cnt."',
    now())";
    $result = $mysqli ->query($sql) or die("query error =>".$mysqli_error);
}
if($result){
    $data = array('result' => 'ok');
} else{
    $data = array('result' => 'fail');
}
echo json_encode($data);


?>
