<?php
    session_start();
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
<div class="container mt-3">
    <form class="row">
        <div class="col-md-4">
            <select name="cate1" id="cate1" class="form-select" aria-label="Default select example">
                <option selected>대분류</option>
                <!-- <option value="A0001">컴퓨터</option> -->
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
    </form>
</div>
<div class="container text-start mt-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cate1Modal">
    대분류 등록
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cate2Modal">
    중분류 등록
    </button>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cate3Modal">
    소분류 등록
    </button>
</div>

<!-- cate1 Modal -->
<div class="modal fade" id="cate1Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">대분류 등록</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <input type="text" class="form-control" name="code1" id="code1" placeholder="코드명을 입력하세요">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="name1" id="name1" placeholder="대분류명을 입력하세요">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
        <button type="button" class="btn btn-primary" onclick="category_save(1)">등록</button>
      </div>
    </div>
  </div>
</div>
<!-- cate2 Modal -->
<div class="modal fade" id="cate2Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">중분류 등록</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <select name="pcode" id="pcode2" class="form-control">
                <option selected>대분류</option>
                <!-- <option value="A0001">컴퓨터</option> -->
                <?php
                    foreach($cate1 as $c){
                ?>
                    <option value="<?php echo $c->code; ?>"><?php echo $c->name; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <input type="text" class="form-control" name="code2" id="code2" placeholder="코드명을 입력하세요">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="name2" id="name2" placeholder="중분류명을 입력하세요">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
        <button type="button" class="btn btn-primary" onclick="category_save(2)">등록</button>
      </div>
    </div>
  </div>
</div>
<!-- cate3 Modal -->
<div class="modal fade" id="cate3Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">소분류 등록</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
        <div class="row">
            <div class="col-md-6">
                <select name="pcode" id="pcode2_1" class="form-control">
                    <option selected>대분류를 선택해주세요</option>
                    <?php
                        foreach($cate1 as $c){
                    ?>
                        <option value="<?php echo $c->code; ?>"><?php echo $c->name; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-6">
                <select name="pcode3" id="pcode3" class="form-control">
                    <option selected>대분류를 먼저해주세요</option>
                   
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <input type="text" class="form-control" name="code3" id="code3" placeholder="코드명을 입력하세요">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="name3" id="name3" placeholder="소분류명을 입력하세요">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
        <button type="button" class="btn btn-primary" onclick="category_save(3)">등록</button>
      </div>
    </div>
  </div>
</div>
<script>
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
    $("#pcode2_1").change(function(){
        let cate = $(this).val(); // $("#cate1 option:selected").val();
        
        let data = {
            cate : cate
        }
        $.ajax({
            async:false,
            type:'post',
            data:data,
            url: "category4.php", 
            dataType:'html',
            success: function(returned_data){
                $("#pcode3").html(returned_data);
            }
        });
    });

    function category_save(step){
        let name = $('#name'+step).val();
        let code = $('#code'+step).val();
        let pcode = $('#pcode'+step+' option:selected').val();

        if(step>1 && !pcode){
            alert('부모 분류를 선택하세요.')
            return;
        }
        if(!code){
            alert('분류 코드를 입력하세요.')
            return;
        }
        if(!name){
            alert('분류명를 입력하세요.')
            return;
        }
        let data = {
            name:name,
            code:code,
            pcode:pcode,
            step:step
        }
        $.ajax({
            async:false,
            type:'post',
            data:data,
            url:'save_category.php',
            dataType:'json',
            error:function() {},
            success:function(returned_data){
                console.log(returned_data);
                 if(returned_data.result ==1)   {
                    alert('등록성공');
                    location.reload(); //새로고침
                 } else if(returned_data.result == -1){
                    alert('코드명 또는 분류명이 이미 사용중입니다.');
                    location.reload(); //새로고침
                 } else{
                    alert('등록실패');
                 }
            }
        });

    }

</script>
<?php
    // $returned_data = array("result" => '-1');
    // print_r($returned_data);
    // print_r(json_encode($returned_data));

    include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";

?>