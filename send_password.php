<?php
    // 유저에게 비밀번호 변경페이지를 이메일로 전달해준다
    // 변경 페이지의 주소에 [email_hash] 를 파라미터로 추가하여
    // DB에서 해당 값을 가지는 계정에서만 비밀번호를 변경할 수 있도록 한다
    // EX) http://192.168.102.129/change_password.php?email_hash=1eabd720489c2929e0ae45ebb2ef26a6}

    // DB 연결
    include_once("../file/dbconnect.php");

    $statement = $conn->prepare("SELECT email_hash FROM user WHERE email = :email");
    $statement->bindParam(':email', $_POST['email']);
    $statement->execute();

    $row = $statement->fetch();
    $email_hash = $row['email_hash'];

    // 이메일 발송파일 호출
    // 받을 이메일 주소와, 이메일 내용 설정 후 전송해야한다 [$mail->Send()]
    include_once("../file/phpmailer_verify.php");
    // 받는사람 이메일 주소
    $mail->AddAddress($_POST['email']);
    // 메일 제목
    $mail->Subject = '[비밀번호 변경]';
    // 이메일 내용
    $mail->Body =
    "[패스워드 변경]

아래 링크를 통해 비밀변호를 변경해주세요.
http://54.180.215.159/change_password.php?email_hash=$email_hash}";
    $mail->Send();

    echo "
        <script>
            alert('[비밀번호 변경]\\n\\n[{$_POST['email']}]\\n계정으로 메일을 발송하였습니다\\n\\n비밀번호 재설정 후 이용해주세요');
            location.href = 'http://54.180.215.159/signin.php';
        </script>
        ";
?>