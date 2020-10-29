<?php
    // DB 연결
    include_once("../file/dbconnect.php");

    try {
        // prepare statement
        $statement = $conn->prepare("INSERT INTO user (email, name, password) 
        VALUES (:email, :name, :password)");
        $statement->bindParam(':email', $_POST['email']);
        $statement->bindParam(':name', $_POST['name']);
        $statement->bindParam(':password', $_POST['password']);// 암호화된 비밀번호를 입력해주어야한다
        $statement->execute();

        // echo "New records created successfully";
    } catch (PDOException $ex) {
        echo "failed! : ".$ex->getMessage()."<br>";
    }
    $conn = null;
?>