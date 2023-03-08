<?php
function user_coupon($userid, $cid, $reason){
    global $mysqli;//함수밖에서 선언된 객체(변수)를 전역 변수로

    $sql = "SELECT cid from coupons where cid='".$cid."'";
    $result = $mysqli -> query($sql) or die("query error =>".$mysqli->error);
    $rs = $result -> fetch_object();

    if($rs->cid == 1){  //회원가입시 발급된 쿠폰, 1회만 발급, 발급 내역 확인
        $sql2 = "SELECT COUNT(*) AS cnt FROM user_coupons WHERE couponid=".$rs->cid." and userid='".$userid."'";
        $result2 = $mysqli -> query($sql2) or die("query error =>".$mysqli->error);
        $rs2 = $result2 -> fetch_object();

        if(!$rs2->cnt){ //cid번호의 쿠폰이 $userid에게 발행되지 않았다면

                //user_coupons 쿠폰사용유저 테이블에 신규발급
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

    } else{
        if($rs -> status == 2){ //사용가능 쿠폰이라면
                //user_coupons 쿠폰사용유저 테이블에 신규발급
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

    }
}



?>