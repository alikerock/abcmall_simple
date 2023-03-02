<?php
    session_start();
    ini_set('display_errors',1);
    include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

    if(!$_SESSION['AUID']){
        echo "<script>
            alert('권한이 없습니다');
            history.back();
        </script>";
        exit;       
    };

$poid = $_POST['poid'];

$sql = "SELECT image_url from product_options where poid='".$poid."'";
// $sql = "SELECT image_url from product_options where poid='{$poid}'";
// $sql = "SELECT image_url from product_options where poid=".$poid;
$result = $mysqli -> query($sql) or die($mysqli -> error);
$rs = $result->fetch_object();
$html = $rs -> image_url;
echo $html;

?>