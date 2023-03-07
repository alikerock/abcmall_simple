<?php
include $_SERVER["DOCUMENT_ROOT"]."/inc/header.php";
?>


    <div class="container">
        <h2>Sign In</h2>
        <form class="row g-3 needs-validation" method="post" action="signin_ok.php">

        <div class="col-12">
            <label for="validationCustom02" class="form-label">아이디</label>
            <input type="text" class="form-control" id="userid" name="userid" placeholder="" required>
        </div>
        <div class="col-12">
            <label for="validationCustom02" class="form-label">비밀번호</label>
            <input type="password" class="form-control" id="passwd" name="passwd" placeholder="" required>
        </div>        
       
        <div class="col-12">
            <button class="btn btn-primary" type="submit">로그인</button>
        </div>
        </form>
    </div>
<?php
include $_SERVER["DOCUMENT_ROOT"]."/inc/footer.php";
?>