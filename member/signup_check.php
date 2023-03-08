<?php session_start();
//db 연결
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


//넘어온 값을 변수 지정
$userid=$_POST["userid"];
$email=$_POST["email"];

$sql = "SELECT COUNT(*) AS cnt FROM members WHERE userid='".$userid."' or email='".$email."'";
$result = $mysqli -> query($sql) or die("query error=>".$mysqli->error);
$rs = $result -> fetch_object();

$data = array("cnt"=>$rs->cnt);
echo json_encode($data);
?>