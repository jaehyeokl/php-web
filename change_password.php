<?php
    // DB 연결
    include_once("../file/dbconnect.php");

    $verify_statement = $conn->prepare("SELECT email FROM user WHERE email_hash = :email_hash");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/change_password.css">
</head>
<body>
    
    <!-- 비밀번호 변경 -->
    <form class="form" action="upload_password.php" method="post">
        <span class="form__text">password</span>
        <input name="password" type="password" minlength="8" maxlength="20" class="form__input" id="password">
        <!-- <span class="form__text">confirm password</span>
        <input type="password" minlength="8" maxlength="20" class="form__input" id="confirm-password"> -->
        <!-- span 공간을 차지하기 위해 visibility: hiddine -->
        <span class="form__text confirm-password">비밀번호가 일치하지 않습니다</span>
        <button name="submit"type="submit" class="form__button" id="submit">비밀번호 변경</button>
    </form>

</body>
</html>