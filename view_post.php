<?php
    // DB 연결
    $mysqli = mysqli_connect("localhost", "root", "wodha", "web");

    // 게시글의 post id 가 포함된 url 에서 id 를 저장한다
    // 저장해둔 게시글의 id 를 sql문에 이용해서 해당 게시글의 데이터만 가져온다
    $post_id = $_GET['id'];
    $sql = "SELECT * FROM general_board WHERE id = $post_id";
    $result = mysqli_query($mysqli, $sql);
        
    // 게시글 배열에서 필요한 데이터만 불러오기
    $row = mysqli_fetch_array($result);
    $title = $row['title'];
    $contents_text = $row['contents_text'];
    $created = $row['created'];

    // 에러 체크
    if ($result === false) {
        echo mysqli_error($mysqli);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/view_post.css">
    <script src="https://kit.fontawesome.com/8451689280.js" crossorigin="anonymous"></script>
    <title>자유게시판 - </title>
</head>
<body>
    <!-- 메뉴바 -->
    <nav class="navbar">
        <div class="navbar__logo">
            <i class="fab fa-html5"></i>
            <a href="/index.html">WebSite</a>
        </div>

        <ul class="navbar__menu">
            <li><a href="board.php">자유게시판</a></li>
            <li><a href="">Menu2</a></li>
            <li><a href="">Menu3</a></li>
            <li><a href="">Menu4</a></li>
        </ul>

        <ul class="navbar__links">
            <li><a href="signin.php">로그인</a></li>
            <li><a href="signup.php">회원가입</a></li>
        </ul>
    </nav>

    <!-- 게시글 보기 -->
    <div class="post">
        <div class="post__header">
            <a href="board.php" class="post__link_board">자유게시판 ></a>
            <h2 class="post__title"><?= $title?></h2>
            <div class="post__information">
                <span>작성자 : 
                <span>작성 날짜 : <?=$created?></span>
                <span>조회수 :</span>
            </div>
        </div>
        <div class="post__contents">
            <textarea readonly maxlength="2000"><?= $contents_text?></textarea>
            <!-- <p></p> -->
        </div>
    </div>
    
</body>
</html>