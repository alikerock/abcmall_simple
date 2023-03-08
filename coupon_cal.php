<?php session_start();
//db 연결
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbcon.php";

$ucid = $_POST['ucid'];
$cart_total = $_POST['cart_total'];

$query2="select c.* from user_coupons uc
join coupons c on c.cid=uc.couponid
where c.status = 2 and uc.ucid=".$ucid." and uc.status = 1 and uc.use_max_date >= now() and uc.userid='".$_SESSION['UID']."'";
$result2 = $mysqli->query($query2) or die("query error => ".$mysqli->error);
$rs2 = $result2->fetch_object();

if(!$rs2){ //사용할수 있는 쿠폰이 없다면
    $data = array("result" => false, "msg" => "사용할 수 없는 쿠폰입니다.");
    echo json_encode($data);
    exit;
} else{
    if($rs2->use_min_price>$cart_total){
        $data = array("result" => false, "msg" => "구매 금액이 최소".$rs2->use_min_price."원이상이여야 합니다.");
        echo json_encode($data);
        exit;
    }
    if($rs2->coupon_type == 1){ //정액차감 쿠폰이라면
        $data = array("result" => true, "coupon_price" => $rs2->use_min_price);
        echo json_encode($data);
        exit;  
    }    
    if($rs2->coupon_type == 2){ //정률차감 쿠폰이라면
        $coupon_price = $cart_total *($rs2->coupon_ratio/100);
        if($rs2->max_value<$coupon_price){
            $coupon_price = $rs2->max_value;
        }
        $data = array("result" => true, "coupon_price" => $coupon_price);
        echo json_encode($data);
        exit;  
    }


}


?>