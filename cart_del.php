<?php
include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

$cid = $_POST['cid'];


$sql = "DELETE from cart where cartid='".$cid."'";
$result = $mysqli ->query($sql) or die("query error =>".$mysqli_error);
if($result){
    $data = array('result' => true);
}else{
    $data = array('result' => false);
}
echo json_encode($data);
?>