<?php
include $_SERVER["DOCUMENT_ROOT"]."/inc/header.php";
?>


    <div class="container">
        <form class="row g-3 needs-validation" method="post" action="signup_ok.php">
        <div class="col-12">
            <label for="validationCustom01" class="form-label">이름</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="" required>
        </div>
        <div class="col-12">
            <label for="validationCustom02" class="form-label">아이디</label>
            <input type="text" class="form-control" id="userid" name="userid" placeholder="" required>
        </div>
        <div class="col-12">
            <label for="validationCustom02" class="form-label">비밀번호</label>
            <input type="password" class="form-control" id="passwd" name="passwd" placeholder="" required>
        </div>
        <div class="col-12">
            <label for="validationCustomUsername" class="form-label">이메일</label>
            <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend">@</span>
            <input type="email" class="form-control" id="email" name="email" placeholder="" required>
            </div>
        </div>
       
        <div class="col-12">
            <button type="button" class="btn btn-primary" id="signup">가입하기</button>
        </div>
        </form>
    </div>
    <script>
        $('#signup').click(function(){
            let userid = $('#userid').val();
            let email = $('#email').val();

            var data={
                userid : userid,
                email:email
            }
            $.ajax({
                async:false,
                type:'post',
                url:'signup_check.php',
                data:data,
                dataType:'json',
                success : function(result){
                    if(result.cnt>0){
                        alert('아이디 또는 이메일이 이미 있습니다, 다시 확인해주세요');
                    } else{
                        $('form').submit();
                    }
                }
            })
        });
    </script>
<?php
include $_SERVER["DOCUMENT_ROOT"]."/inc/footer.php";
?>
