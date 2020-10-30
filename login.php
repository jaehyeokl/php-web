<?php
    // DB 연결
    include_once("../file/dbconnect.php");

    try {
        // prepare statement
        $statement = $conn->prepare("SELECT * FROM user WHERE email = :email");
        $statement->bindParam(':email', $_POST['email']);
        $statement->execute();


        // 유저가 계정이 회원가입 된 상태인지 체크
        // $statement->rowCount() (1:가입된 계정 / 0:가입X)
        if ($statement->rowCount() == 1) {
            // 가입된 계정일때
            $row = $statement->fetch();
            $password = $row['password'];
            
            // DB에 저장된 비밀번호와 유저가 입력한 비밀번호 일치여부 확인
            if ($password === $_POST['password']) {
                // 비밀번호 일치 -> 로그인
                // 세션변수에 email, name 을 저장한다
                // 다른 웹 페이지에서 세션에 저장한 변수의 유무를 통해 로그인 여부를 확인한다
                session_start();
                $_SESSION['email'] = $row['email'];
                $_SESSION['name'] = $row['name'];
                
                header("Location: http://192.168.102.129");
                die();

            } else {
                // 비밀번호가 일치하지 않을때
                echo "
                <script>
                    alert('비밀번호가 일치하지 않습니다');
                    history.back();
                </script>
                ";
            }

        } else {
            // 가입된 계정이 아닐때
            echo "
                <script>
                    alert('존재하지 않는 계정입니다');
                    history.back();
                </script>
                ";
        }

    } catch (PDOException $ex) {
        echo "failed! : ".$ex->getMessage()."<br>";
    }
    $conn = null;
?>