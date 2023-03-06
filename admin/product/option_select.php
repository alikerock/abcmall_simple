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

$poid1 = $_POST['poid1'];
$poid2 = $_POST['poid2'];

if(isset($poid1)){
    $sql = "SELECT * from product_options where poid='".$poid1."'";
    $result = $mysqli -> query($sql) or die($mysqli -> error);
    $rs = $result->fetch_object();
    $op1_price = $rs -> option_price;
    $op1_img = $rs -> image_url;
}
if(isset($poid2)){    
    $sql = "SELECT option_price from product_options where poid='".$poid2."'";
    $result = $mysqli -> query($sql) or die($mysqli -> error);
    $rs = $result->fetch_object();
    $op2_price = $rs -> option_price;
}
if(isset($poid1) || isset($poid2)){    
    $return_data = array("option_price1" => $op1_price, "image_url" => $op1_img,"option_price2" => $op2_price);
    echo json_encode($return_data);
}


?>