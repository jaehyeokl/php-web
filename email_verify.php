<?php
    // 회원가입 직후 유저에게 전달된 이메일의 링크를 통해 들어올 수 있는 페이지
    // url 에 유저의 email, email_hash 값이 파라미터로 포함되어 있기 때문에
    // http://192.168.102.129/email_verify.php?email=hyukzza@naver.com&email_hash=1eabd720489c2929e0ae45ebb2ef26a6
    // 파라미터 값과, DB에 저장된 값을 비교하여 일치할때, 유저 이메일 인증 완료 -> 계정 활성화

    // 파라미터 값이 없을때(비정상적인 경로로 페이지 접근 시) 홈으로 이동
    if (!isset($_GET['email']) || !isset($_GET['email_hash'])) {
        header("Location: http://54.180.215.159");
        die("비정상 경로 접근");
    }

    // DB 연결
    include_once("../file/dbconnect.php");

    try {
        $statement = $conn->prepare("SELECT email_hash, active FROM user WHERE email = :email");
        $statement->bindParam(':email', $_GET['email']);
        $statement->execute();

        $row = $statement->fetch();

        // 계정 이메일 인증 여부 확인
        if (!$row['active'] == 1) {
            // email_hash 파라미터 값과 DB의 값 비교
            if ($row['email_hash'] === $_GET['email_hash']) {
            // DB의 유저데이터에서 계정을 활성화상태로 변경
            $active_statement = $conn->prepare("UPDATE user SET active = 1  WHERE email = :email");
            $active_statement->bindParam(':email', $_GET['email']);
            $active_statement->execute();

            echo "
                <script>
                    alert('이메일 인증이 완료되었습니다');
                    location.href = 'http://54.180.215.159';
                </script>
                ";
            }
        } else {
            // 이미 인증 완료했지만, 해당 링크로 또 페이지 접근했을 경우
            header("Location: http://54.180.215.159");
            die("인증된 계정으로 url 접근");
        }

        // echo "New records created successfully";
    } catch (PDOException $ex) {
        echo "failed! : ".$ex->getMessage()."<br>";
    }
    $conn = null;
?>