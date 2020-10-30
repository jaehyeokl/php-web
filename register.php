<?php
    // DB 연결
    include_once("../file/dbconnect.php");

    try {
        // prepare statement
        $statement = $conn->prepare("INSERT INTO user (email, name, password) 
        VALUES (:email, :name, :password)");
        $statement->bindParam(':email', $_POST['email']);
        $statement->bindParam(':name', $_POST['name']);
        $statement->bindParam(':password', $_POST['password']);
        $statement->execute();

        // echo "New records created successfully";
    } catch (PDOException $ex) {
        echo "failed! : ".$ex->getMessage()."<br>";
        // echo "failed! : ".$ex->getCode()."<br>";

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