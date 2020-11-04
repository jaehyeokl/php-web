<?php
    // DB 연결
    include_once("../file/dbconnect.php");

    try {
        // prepare statement
        $statement = $conn->prepare("INSERT INTO user (email, name, password, email_hash) 
        VALUES (:email, :name, :password, :email_hash)");
        $statement->bindParam(':email', $_POST['email']);
        $statement->bindParam(':name', $_POST['name']);
        $statement->bindParam(':password', $_POST['password']);
        $statement->bindParam(':email_hash', $email_hash);
        // 이메일을 MD5 hash 값으로 만들어 전달한다
        // 사용자 이메일 인증 시 고유 url 주소를 만드는데 사용된다
        $email_hash = hash('md5', $_POST['email'], false);
        $statement->execute();
        
        // 이메일 발송파일 호출
        // 받을 이메일 주소와, 이메일 내용 설정 후 전송해야한다 [$mail->Send()]
        include_once("../file/phpmailer_verify.php");
        // 메일 제목
        $mail->Subject = '[가입인증] Please verify your email address.';
        // 받는사람 이메일 주소
        $mail->AddAddress($_POST['email']);
        // 이메일 내용
        $mail->Body =
        "[이메일 인증]

계정이 생성되었습니다!
아래 링크를 눌러 계정을 인증해주세요. 인증 이후 로그인이 가능합니다.
http://192.168.102.129/email_verify.php?email={$_POST['email']}&email_hash=$email_hash
        ";
        $mail->Send();

        // 회원가입 완료 메세지, 로그인페이지로 돌아가기
        echo "
            <script>
                alert('[인증 요청]\\n\\n[{$_POST['email']}]\\n계정으로 인증 메일을 발송하였습니다\\n\\n이메일 인증 이후 이용가능합니다');
                location.href = 'http://192.168.102.129/signin.php';
            </script>
            ";

        // echo "New records created successfully";
    } catch (PDOException $ex) {
        echo "failed! : ".$ex->getMessage()."<br>";
        echo "failed! : ".$ex->getCode()."<br>";

        // Error Code : 23000  -> 무결성 제약 조건 위반
        // 유저가 입력한 아이디가 기존 데이터에 존재할때(이미 가입되어있을때)
        // 유저에게 메세지 전달 후 이전페이지로 이동
        if ($ex->getCode() === '23000') {
            $conn = null;
            echo "
                <script>
                    alert('이미 가입된 계정입니다');
                    history.back();
                </script>
                ";
        }
    }
    $conn = null;
?>