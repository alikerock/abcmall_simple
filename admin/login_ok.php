<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']."/inc/dbcon.php";

    $userid = $_POST["userid"];
    $passwd = $_POST["passwd"];
    $passwd = hash('sha512',$passwd);

    $sql = "SELECT * from admins where userid='{$userid}' and passwd='{$passwd}'";
    $result = $mysqli -> query($sql);
    $rs = $result ->fetch_object();

    if($rs){
        $sql = "UPDATE admins set last_login=now() where idx = '{$rs->idx}'";
        $result = $mysqli -> query($sql);
        $_SESSION['AUID'] = $rs->userid;
        $_SESSION['AUNAME'] = $rs->username;
        $_SESSION['ALEVEL'] = $rs->level;
        echo "<script>
            alert('관리자님 어서오세요');
            location.href='/admin/product/product_list.php';
        </script>";
        exit;
    } else{
        echo "<script>
            alert('아이디 또는 암호가 일치하지 않습니다.');
            history.back();
        </script>";
        exit;
    }
?>