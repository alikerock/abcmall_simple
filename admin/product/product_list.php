<?php
    session_start();
    if(!$_SESSION['AUID']){
        echo "<script>
            alert('접근 권한이 없습니다.');
            history.back();
        </script>";
    };

    include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";

    // $pageNumber = isset($pageNumber) ? $pageNumber :1;
    $pageNumber = $pageNumber??1; //중복연산자 ?? 
    if($pageNumber < 1) $pageNumber = 1;
    $pageCount  = $_GET['pageCount']??10;//페이지당 몇개씩 보여줄지, 없으면 10
    $startLimit = ($pageNumber-1)*$pageCount;//쿼리의 limit 시작 부분 ... limit 0, 10
    $firstPageNumber  = $_GET['firstPageNumber'];

    $cate1  = $_GET['cate1']??'';
    $cate2  = $_GET['cate2']??'';    
    $cate3  = $_GET['cate3']??'';
    $ismain = $_GET["ismain"]??'';
    $isnew = $_GET["isnew"]??'';
    $isbest = $_GET["isbest"]??'';
    $isrecom = $_GET["isrecom"]??'';
    $sale_end_date=$_GET["sale_end_date"]??'';
    $search_keyword=$_GET["search_keyword"]??'';


    
    $query = "SELECT * from category where step=1";
    $result = $mysqli -> query($query) or die("query error =>".$mysqli->error);
    while($rs = $result -> fetch_object()){
        $cate1array[]=$rs;
    }    

    if($cate1 ){
        $query = "SELECT * from category where step=2 and pcode='{$cate1}'";
        $result = $mysqli -> query($query) or die("query error =>".$mysqli->error);
        while($rs = $result -> fetch_object()){
            $cate2array[]=$rs;
        }    
    }

    if($cate2 ){
        $query = "SELECT * from category where step=3 and pcode='{$cate2}'";
        $result = $mysqli -> query($query) or die("query error =>".$mysqli->error);
        while($rs = $result -> fetch_object()){
            $cate3array[]=$rs;
        }    
    }

    $scate = $cate1.$cate2.$cate3;
    if($scate){
        $search_where = " and cate like '".$scate."%'";
    }

    if($ismain){//값이 있는 경우에만 검색 조건에 추가한다.
        $search_where.=" and ismain=1";
    }
        
    if($isnew){
        $search_where.=" and isnew=1";
    }    
    
    if($isbest){
        $search_where.=" and isbest=1";
    }  
    
    if($isrecom){
        $search_where.=" and isrecom=1";
    }
        
    if($sale_end_date){
        $search_where.=" and sale_end_date<='".$sale_end_date."'"; //판매 종료일이 지나지 않은 상품 조회
    }


    if($search_keyword){
        $search_where.=" and (name like '%".$search_keyword."%' or content like '%".$search_keyword."%')";
        //like 상품명 또는 상세설명 내용에서 검색
    }


    $sql = "SELECT * from products where 1=1";
    $sql .= $search_where; 
    $order = " order by pid desc";//최근 등록 순으로 정렬
    $limit = " limit $startLimit, $pageCount"; //0번째에서 10개까지  
    $query = $sql.$order.$limit; //쿼리 문장 조합
  

    $result = $mysqli->query($query) or die("query error => ".$mysqli->error);
    while($rs = $result->fetch_object()){
        $rsc[]=$rs; //검색된 상품 목록 배열에 담기
    }
    

    $sqlcnt = "SELECT count(*) as cnt from products where 1=1";
    $sqlcnt .= $search_where;
    $countresult = $mysqli -> query($sqlcnt) or die("query error => ".$mysqli->error);
    $rscnt = $countresult ->fetch_object();
    $totalcount = $rscnt -> cnt;    
    $totalPage = ceil($totalcount/$pageCount);

    if($firstPageNumber < 1) $firstPageNumber = 1;
    $lastPageNumber = $firstPageNumber + $pageCount - 1;// 1+10-1 페이징 나오는 부분에서 레인지를 정한다. 페이지 번호 10개 출력
    if($lastPageNumber > $totalPage) $lastPageNumber = $totalPage; //페이저번호가 총 페이지수보다 많다면 작은수로

    function isStatus($n){  //목록에서 상품의 상태를 변경할 때 숫자를 isSatus함수에 전달하여 변경

        switch($n) {           
            case -1:$rs="판매중지";
            break;
            case 0:$rs="대기";
            break;
            case 1:$rs="판매중";
            break;
        }
        return $rs;
    }




?>
<div class="container">
    <h2>상품 리스트</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="get">
        <div class="row">
        <div class="col-md-4">
            <select class="form-select" name="cate1" id="cate1" aria-label="Default select example">
                <option value="">대분류</option>
                <?php
                        foreach($cate1array as $c){
                    ?>
                <option value="<?php echo $c->code;?>" <?php if($cate1==$c->code){echo "selected";}?>><?php echo $c->name;?></option>


                <?php }?>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-select" name="cate2" id="cate2" aria-label="Default select example">
                <option value="">중분류</option>
                <?php
                        foreach($cate2array as $c){
                    ?>
                        <option value="<?php echo $c->code;?>" <?php if($cate2==$c->code){echo "selected";}?>><?php echo $c->name;?></option>
                    <?php }?>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-select" name="cate3" id="cate3" aria-label="Default select example">
                <option value="">소분류</option>
                <?php
                        foreach($cate3array as $c){
                    ?>
                        <option value="<?php echo $c->code;?>" <?php if($cate3==$c->code){echo "selected";}?>><?php echo $c->name;?></option>
                    <?php }?>
            </select>
        </div>

        </div>
        <div class="input-group mb-12 w-100 p-10">
            <input class="form-check-input" type="checkbox" name="ismain" id="ismain" value="1" <?php if($ismain){echo "checked";}?>>메인
            <input class="form-check-input" type="checkbox" name="isnew" id="isnew" value="1" <?php if($isnew){echo "checked";}?>>신제품
            <input class="form-check-input" type="checkbox" name="isbest" id="isbest" value="1" <?php if($isbest){echo "checked";}?>>베스트
            <input class="form-check-input" type="checkbox" name="isrecom" id="isrecom" value="1" <?php if($isrecom){echo "checked";}?>>추천
            판매종료일:<input type="text" class="form-control" style="max-width:150px;" name="sale_end_date"
                id="sale_end_date">
            <input type="text" class="form-control" name="search_keyword" id="search_keyword" placeholder="제목과 내용에서 검색합니다."
                value="<?php echo $search_keyword;?>" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="submit" id="search">검색</button>
        </div>
    </form>
    <form method="get" name="plist" action="plist_save.php" class="mt-3 mb-3 text-center">
        <button class="btn btn-primary">변경내용 저장</button>
    
        <table class="table table-sm table-bordered">
        <thead>
            <tr class="text-center">
                <th scope="col">사진</th>
                <th scope="col">제품명</th>
                <th scope="col">가격</th>
                <th scope="col">재고</th>
                <th scope="col">메인</th>
                <th scope="col">신제품</th>
                <th scope="col">베스트</th>
                <th scope="col">추천</th>
                <th scope="col">상태</th>
                <th scope="col">보기</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($rsc)){            
                    foreach($rsc as $r){ //조회된 상품 데이터 출력
                ?>
                <input type="hidden" name="pid[]" value="<?php echo $r->pid;?>">
            <tr>
                <th scope="row" class="w-25"><img src="<?php echo $r->thumbnail;?>" class="w-100"></th>
                <td><?php echo $r->name;?></td>
                <td class="text-right"><s><?php echo number_format($r->price);?>원</s>
                    <?php if($r->sale_price>0){?>
                    <br>
                    <?php echo number_format($r->sale_price);?>원
                    <?php }?>
                </td>
                <td class="text-right"><?php echo number_format($r->cnt-$r->sale_cnt);?>EA</td>
                <td class="text-center"><input type="checkbox" name="ismain[<?php echo $r->pid;?>]"
                        id="ismain_<?php echo $r->pid;?>" value="1" <?php if($r->ismain){echo "checked";}?>></td>
                <td class="text-center"><input type="checkbox" name="isnew[<?php echo $r->pid;?>]"
                        id="isnew_<?php echo $r->pid;?>" value="1" <?php if($r->isnew){echo "checked";}?>></td>
                <td class="text-center"><input type="checkbox" name="isbest[<?php echo $r->pid;?>]"
                        id="isbest_<?php echo $r->pid;?>" value="1" <?php if($r->isbest){echo "checked";}?>></td>
                <td class="text-center"><input type="checkbox" name="isrecom[<?php echo $r->pid;?>]"
                        id="isrecom_<?php echo $r->pid;?>" value="1" <?php if($r->isrecom){echo "checked";}?>></td>
                <td class="text-center">
                    <select class="form-select" style="max-width:120px;" name="stat[<?php echo $r->pid;?>]" id="stat" aria-label="Default select example">
                        <option value="-1" <?php if($r->status==-1){echo "selected";}?>>판매중지</option>
                        <option value="0" <?php if($r->status==0){echo "selected";}?>>대기</option>
                        <option value="1" <?php if($r->status==1){echo "selected";}?>>판매중</option>
                    </select>
                </td>
                <td class="text-center">
                    <a href="product_view.php?pid=<?php echo $r->pid;?>" class="btn btn-primary">보기</a>
                </td>
            </tr>
            <?php } } else {?>
                <td class="text-center" colspan="9">검색 결과가 없습니다.</td>
                <?php } ?>
        </tbody>    
    </table>
    </form>
<a href="product_up.php" class="btn btn-primary">
    제품등록
</a>

    
</div>


<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    $(function () {
        $("#sale_end_date").datepicker({
            dateFormat: 'yy-mm-dd'
        });

    });

    $("#cate1").change(function(){
        var cate1 = $("#cate1 option:selected").val();
       
        var data = {
            cate1 : cate1
        };
            $.ajax({
                async : false ,
                type : 'post' ,
                url : 'category2.php' ,
                data  : data ,
                dataType : 'html' ,
                error : function() {} ,
                success : function(return_data) {
                    $("#cate2").html(return_data);
                }
        });
    });


    $("#cate2").change(function(){
        var cate2 = $("#cate2 option:selected").val();
       
        var data = {
            cate2 : cate2
        };
            $.ajax({
                async : false ,
                type : 'post' ,
                url : 'category3.php' ,
                data  : data ,
                dataType : 'html' ,
                error : function() {} ,
                success : function(return_data) {
                    $("#cate3").html(return_data);
                }
        });
    });      



</script>


<?php
    include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";

?>