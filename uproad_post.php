<?php
    // 자유게시판(board.php)의 글쓰기(write_post.php)에서
    // 작성완료를 눌렀을때 데이터를 저장하기 위해 실행된다

    // DB 연결
    // require_once("./dbconnect.php");

    // DB 연결
    $mysqli = mysqli_connect("localhost", "root", "wodha", "web");

    // write_post.php 에서 전달받은 값으로 SQL문 작성
    $title = $_POST['title'];
    $contents_text = $_POST['contents_text'];

    $sql = "
        INSERT INTO general_board (
        title,
        contents_text,
        created
    ) VALUES (
        '$title',
        '$contents_text',
        NOW()
    )";

    // SQL문 전송 및 오류확인
    $result = mysqli_query($mysqli, $sql);

    if ($result === false) {
        echo mysqli_error($mysqli);
    }

    // 자유게시판으로 리다이렉트
    header("Location: http://192.168.102.129/board.php");
    die();
?>