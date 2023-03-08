<?php session_start();
//db 연결
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";
include $_SERVER["DOCUMENT_ROOT"]."/inc/lib.php";


//넘어온 값을 변수 지정
$userid=$_POST["userid"];
$username=$_POST["username"];
$passwd=$_POST["passwd"];
$passwd=hash('sha512',$passwd);
$email=$_POST["email"];


//쿼리 작성 실행
$mysqli->autocommit(FALSE);

try {
    //회원가입
    $query="INSERT INTO members
    (userid, username, passwd, email)
    VALUES('".$userid."'
    , '".$username."'
    , '".$passwd."'
    , '".$email."'
    )";
    $rs=$mysqli->query($query) or die($mysqli->error);

    user_coupon($userid, 1, '회원가입');
        
    $mysqli->commit();//디비에 커밋한다.

    echo "<script>alert('회원가입 성공!, 10,000만원 쿠폰을 발행해 드렸습니다.');
    location.href='/index.php';</script>";
    exit;
}catch (Exception $e) {
    $mysqli->rollback();
    echo "<script>alert('회원가입 실패!');history.back();</script>";
    exit;
}




?>