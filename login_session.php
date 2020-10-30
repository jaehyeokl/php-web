<!-- 로그인 여부 확인 -->
<?php
    session_start();
    // SESSION 전역변수의 값이 있을때 로그인 상태가 된다
    if (isset($_SESSION['name'])) {
        $login_session = true;
    }
?>