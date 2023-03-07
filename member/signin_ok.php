<?php session_start();
//db 연결
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


//넘어온 값을 변수 지정
$userid=$_POST["userid"];
$passwd=$_POST["passwd"];
$passwd=hash('sha512', $passwd);

$sql = "SELECT * from members where userid='".$userid."' and passwd='".$passwd."'";
$result = $mysqli -> query($sql) or die('Query error=>'.$mysqli->error);
$rs = $result->fetch_object();

if($rs){
    $_SESSION['UID'] = $rs->userid;
    $_SESSION['UNAME'] = $rs->username;
    $sql = "UPDATE cart set userid='".$userid."' where ssid='".session_id()."'"; 
    $result = $mysqli -> query($sql) or die('Query error=>'.$mysqli->error);
    echo "<script>alert('어서오세요');</scipt>";
    exit;
} else{
    echo "<script>alert('아이디 또는 암호가 맞지 않습니다.'); history.back()</scipt>";
    exit;
}