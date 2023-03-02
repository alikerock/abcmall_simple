<?php session_start();
//db 연결
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";


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

    //쿠폰목록 조회
    // $cp_sql = "SELECT cid from coupons where cid=1";
    // $cp_sql_result= $mysqli -> query($cp_sql) or die("query error:".$mysqli->error);
    // $cp_result = $cp_sql_result -> fetch_object();

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


function user_coupon($userid, $cid, $reason){
    global $mysqli;//함수밖에서 선언된 객체(변수)를 전역 변수로
    //user_coupons 쿠폰사용유저 테이블
    $last_date = date("Y-m-d 23:59:59", strtotime("+30 days"));

    $sql="INSERT INTO user_coupons
    (couponid, userid, status, use_max_date, regdate, reason)
    VALUES('".$cid."'
    , '".$userid."'
    , 1
    , '".$last_date."'
    , now()
    , '".$reason."'
    )";

    $rs = $mysqli -> query($sql) or die("query error:".$mysqli->error);
}


?>