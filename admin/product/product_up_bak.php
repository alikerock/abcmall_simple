<?php
    session_start();
    ini_set('display_errors',1);

    if(!$_SESSION['AUID']){
        echo "<script>
            alert('접근 권한이 없습니다.');
            history.back();
        </script>";
    };

    include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";

    $query = "SELECT * from category where step=1";

    $result = $mysqli -> query($query) or die("query error =>".$mysqli->error);

    while($rs = $result -> fetch_object()){
        $cate1[]=$rs;
    }    
?>
<!-- include summernote css/js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.css" integrity="sha512-m52YCZLrqQpQ+k+84rmWjrrkXAUrpl3HK0IO4/naRwp58pyr7rf5PO1DbI2/aFYwyeIH/8teS9HbLxVyGqDv/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js" integrity="sha512-6rE6Bx6fCBpRXG/FWpQmvguMWDLWMQjPycXMr35Zx/HRD9nwySZswkkLksgyQcvrpYMx0FELLJVBvWFtubZhDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<div class="container">
    <h3 class="text-center p-5">제품 등록하기</h3>
    <form action="product_ok.php" method="POST" onsubmit="return save();" enctype="multipart/form-data"> 
         <input type="hidden" name="file_table_id" id="file_table_id" value="">
         <input type="hidden" name="contents" id="contents" value="">

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th scope="row" class="text-center align-middle">카테고리 선택</th>
                    <td>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <select name="cate1" id="cate1" class="form-select" aria-label="Default select example">
                                    <option selected>대분류</option>
                                    <?php
                                        foreach($cate1 as $c){
                                    ?>
                                        <option value="<?php echo $c->code; ?>"><?php echo $c->name; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="cate2" id="cate2" class="form-select" aria-label="Default select example">
                                    <option selected>중분류</option>             

                                </select>
                            </div>
                            <div class="col-md-4">
                                <select name="cate3" id="cate3" class="form-select" aria-label="Default select example">
                                    <option selected>소분류</option>             

                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="text-center align-middle">제품명</th>
                    <td>
                        <input type="text" class="form-control" name="name" id="name">
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="text-center align-middle">택배비</th>
                    <td><input type="number" class="form-control text-right"
                            name="delivery_fee" id="delivery_fee"></td>
                </tr>
                <tr>
                    <th scope="row" class="text-center align-middle">제품가격</th>
                    <td><input type="number" class="form-control text-right" name="price"
                            id="price"></td>
                </tr>
                <tr>
                    <th scope="row" class="text-center align-middle">세일가격</th>
                    <td><input type="number" class="form-control text-right" 
                            name="sale_price" id="sale_price"></td>
                </tr>
                <tr>
                    <th scope="row" class="text-center align-middle">세일비율</th>
                    <td><input type="number" class="form-control text-right" 
                            name="sale_ratio" id="sale_ratio"></td>
                </tr>
                <tr>
                    <th scope="row" class="text-center align-middle">재고</th>
                    <td><input type="number" class="form-control text-right" name="cnt"
                            id="cnt">
                    </td>
                </tr>                
                <tr>
                    <th scope="row" class="text-center align-middle">전시옵션</th>
                    <td>
                        <input class="form-check-input" type="checkbox" name="ismain" value="1" id="ismain"><label for="ismain">메인</label>
                        <input class="form-check-input" type="checkbox" name="isnew" value="1" id="isnew"><label for="isnew">신제품</label>
                        <input class="form-check-input" type="checkbox" name="isbest" value="1" id="isbest"><label for="isbest">베스트</label>
                        <input class="form-check-input" type="checkbox" name="isrecom" value="1" id="isrecom"><label for="isrecom">추천</label>
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="text-center align-middle">위치지정</th>
                    <td>
                        <select class="form-select" name="locate" id="locate" aria-label="Default select example">
                            
                            <option value="0">지정안함</option>
                            <option value="1">1번 위치</option>
                            <option value="2">2번 위치</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="text-center align-middle">판매 종료일</th>
                    <td>
                        <input type="text" class="form-control" name="sale_end_date" id="sale_end_date">
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="text-center align-middle">상세설명</th>
                    <td>
                        <div id="summernote"></div>
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="text-center align-middle">썸네일</th>
                    <td>
                        <input type="file" class="form-control" name="thumbnail" id="thumbnail">
                    </td>
                </tr>
                <tr>
                    <th scope="row" class="text-center align-middle">추가이미지</th>
                    <td>
                        <input type="file" multiple name="upfile[]" id="upfile" style="display:none;">
                        <div id="target_file_wrap">
                            <span onclick="jQuery('#upfile').click()" class="btn btn-primary btn-sm">이미지 선택</span>
                        </div>
                        <div class="row row-cols-4" id="imageArea"></div>
                    </td>
                </tr>
                <tr><!-- 옵션 입력폼 (컬러) -->
                    <input type="hidden" name="optionCate1" id="optionCate1" value="컬러">
                    <th scope="row" class="text-center align-middle">컬러</th>                    
                    <td>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">옵션명</th>
                                    <th scope="col">재고</th>
                                    <th scope="col">가격</th>
                                    <th scope="col">이미지</th>
                                </tr>
                            </thead>
                            <tbody id="option1">
                                <tr id="optionTr1">
                                    <th scope="row">
                                        <input class="form-control" type="text" style="max-width:200px;" value=""
                                            name="optionName1[]">
                                    </th>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control" class="w-100" value="0"
                                                name="optionCnt1[]">
                                            <span class="input-group-text">개</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <input type="text" class="form-control" class="w-100" value="0"
                                                name="optionPrice1[]">
                                            <span class="input-group-text">원</span>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="file" class="form-control" name="optionImage1[]" id="optionImage1">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-secondary" type="button" onclick="opt1cp()">옵션추가</button>
                    </td>
                 </tr><!-- //옵션 입력폼 (컬러) -->

            </tbody>
        </table>
        <button class="btn btn-primary">등록</button>
    </form>
</div>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>

<script>
    function opt1cp(){
        let addHtml2 = $('#optionTr1').html();
        let addHtml = `<tr>${addHtml2}</tr>`;
        $('#option1').append(addHtml);
    }


    function save(){
        let markup = $('#summernote').summernote('code');
        let contents = encodeURIComponent(markup);
        $("#contents").val(contents);
    }
    $('#upfile').change(function(){
        let files = $('#upfile').prop('files');
        for(let i = 0; i< files.length; i++){
            attachFile(files[i]);
        }
        $('#upfile').val('');
    });

    function attachFile(file){
        var formData = new FormData();                  
        formData.append('savefile', file);
        //<input name="savefile" value="첨부파일명">
        console.log(formData);
                              
        $.ajax({
                url: 'product_save_image.php',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,                         
                type: 'post',
                dataType:'json',
                beforeSend: function(){},//product_save_image.php 응답하기전 할일
                error:function(){},//product_save_image.php 없으면 할일
                success: function(return_data){ //product_save_image.php 유무
                    console.log(return_data);
                    //관리자 유무, 어드민아니면 로그인메시지
                    if(return_data.result == "member"){
                        alert('관리자로 로그인하세요');
                        return;
                    } else if(return_data.result == "size"){
                        alert('10메가 이하만 첨부할 수 있습니다.');
                        return;                    
                    } else if(return_data.result == "image"){
                        alert('이미지만 첨부할 수 있습니다.');
                        return;
                    } else if(return_data.result == "error"){
                        alert('첨부실패, 관리자에게 문의하세요');
                        return;
                    } else{
                        let imgid = $("#file_table_id").val() + return_data.imgid + ",";
                    $("#file_table_id").val(imgid);
                    var html = "<div class='col' id='f_" + return_data.imgid +
                        "'><div class='card h-100'><img src='/pdata/" + return_data.savename +
                        "' class='card-img-top'><div class='card-body'><button type='button' class='btn btn-warning' onclick='file_del(" +
                        return_data.imgid + ")'>삭제</button></div></div></div>";

                        $('#imageArea').append(html);
                    }   
                }
        });
    }

    function file_del(imgid){
        if(!confirm('삭제하시겠습니까?')){
            return false;
        }
        let data = {
            imgid : imgid
        }

        $.ajax({
            async:false, //응답결과 있으면 실행,
            url:'image_delete.php',
            type:'post',
            data: data,
            // dataType:'text',
            success:function(return_data){
                console.log(typeof return_data);
                if(return_data.result == "member"){
                        alert('관리자로 로그인하세요');
                        return;
                } else if(return_data.result == "my"){
                    alert('본인이 작성한 제품의 이미지만 삭제할 수 있습니다.');
                    return;                    
                } else if(return_data.result == "no"){
                    alert('삭제실패, 관리자에게 문의하세요');
                    return;
                } else{
                    $('#f_'+imgid).hide();
                }
            }            
        })
    }

    $('#summernote').summernote({
        height: 300
    });

    $( "#sale_end_date" ).datepicker({
        dateFormat:'yy-mm-dd'
    });

    $("#cate1").change(function(){
        let cate1 = $(this).val(); // $("#cate1 option:selected").val();
        
        let data = {
            cate1 : cate1
        }
        $.ajax({
            async:false,
            type:'post',
            data:data,
            url: "category2.php", 
            dataType:'html',
            success: function(returned_data){
                $("#cate2").html(returned_data);
            }
        });

    }); //#cate1 change
    $("#cate2").change(function(){
        let cate2 = $(this).val(); // $("#cate1 option:selected").val();
        
        let data = {
            cate2 : cate2
        }
        $.ajax({
            async:false,
            type:'post',
            data:data,
            url: "category3.php", 
            dataType:'html',
            success: function(returned_data){
                $("#cate3").html(returned_data);
            }
        });

    }); //#cate1 change    


</script>
<?php
    include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";

?>