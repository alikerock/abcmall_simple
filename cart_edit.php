<?php
include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

$cid = $_POST['cid'];
$qty = $_POST['qty'];

$sql = "UPDATE cart set cnt='".$qty."' where cartid='".$cid."'";
$result = $mysqli ->query($sql) or die("query error =>".$mysqli_error);

$data = array('result' => 'ok');
echo json_encode($data);
?>