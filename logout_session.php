<!-- 로그아웃 -->
<?php
    session_start();
    session_unset();
    session_destroy();

    header("Location: http://192.168.102.129");
    die();
?>