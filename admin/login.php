<?php
    include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
?>

<main class="container text-center">
    <form action="login_ok.php" method="post">
        <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo-shadow.png" alt="" style="width:30px;">
        <h1 class="h3">쇼핑몰 관리자 로그인</h1>
        <div class="form-floating mb-3 mt-5">
            <input type="text" class="form-control" name="userid" id="floatingInput" placeholder="아이디 입력">
            <label for="floatingInput">아이디를 입력하세요.</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="passwd" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">비밀번호를 입력하세요</label>
        </div>
        <button type="submit" class="btn btn-primary mt-3">로그인</button>
    </form>
</main>


<?php
    include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>
