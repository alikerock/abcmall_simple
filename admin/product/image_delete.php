<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

    if(!$_SESSION['AUID']){
        $return_data = array("result"=>"member");
        echo json_encode($return_data); 
        exit;       
    };
    
    $imgid = $_POST['imgid'];
    $sql = "SELECT * from product_image_table where imgid='{$imgid}'";
    $result = $mysqli -> query($sql);
    $rs = $result -> fetch_object();

    if($rs->userid  != $_SESSION['AUID']){
        $return_data = array("result" => "my");
        echo json_encode($return_data); 
        exit;       
    }
    $sql = "UPDATE product_image_table set status=0 where imgid='{$imgid}'";
    $result = $mysqli -> query($sql);


    if($result){
        $delete_file = $_SERVER['DOCUMENT_ROOT'].'/pdata/'.$rs->filename;
        unlink($delete_file); //파일 삭제
        $return_data = array("result" => "ok");
        echo json_encode($return_data);    
    } else{
        $return_data = array("result" => "no");
        echo json_encode($return_data);             
    }


?>

