<!-- 로그아웃 -->
<?php
    session_start();
    session_unset();
    session_destroy();

    header("Location: https://ego-lego.site");
    die();
?>