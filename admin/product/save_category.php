<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";
    
    if(!$_SESSION['AUID']){
        echo "<script>
            alert('접근 권한이 없습니다.');
            history.back();
        </script>";
    };

    $name = $_POST['name'];
    $code = $_POST['code'];
    $pcode = $_POST['pcode'];
    $step = $_POST['step'];

    //코드와 분류명 있는지 확인
    $sql = "SELECT cid from category where step='{$step}' and (name='{$name}' or code='{$code}')";
    $result = $mysqli -> query($sql);
    $rs = $result->fetch_object();
    if($rs->cid){
        $returned_data = array("result" => '-1');
        echo json_encode($returned_data);
        exit;
    }
    $sql = "INSERT INTO category 
    (code, pcode, name, step) 
    VALUES('{$code}','{$pcode}','{$name}','{$step}')";
    $result = $mysqli -> query($sql);

    if($result){
        $returned_data = array("result" => '1');
        echo json_encode($returned_data);
    }else{
        $returned_data = array("result" => '0');
        echo json_encode($returned_data);
    }

?>