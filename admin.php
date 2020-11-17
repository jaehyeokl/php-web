<?php 
  include 'login_session.php';
?>

<?php
    $user_ip = $_SERVER['REMOTE_ADDR'];

    // 날짜를 Primiar Key로 가지는 테이블을 생성한다, 방문자 수, 방문자 아이피를 저장하기 위함
    // 날짜가 바뀔때마다 row가 생성되도록 한다

    // 웹페이지 방문 시 아이피를 저장하는 쿠키를 생성한다 (만료시간 당일 00:00 시)
    // 쿠키가 이미 있으면 방문자 수 집계하지 않고, 없으면 쿠키를 생성하며
    // DB에 방문자수 (+1), 방문자 아이피를 저장한다

    // 관리자 페이지에서 DB의 방문자수를 보여준다
    // DB의 방문자 아이피들을 통해 접속 지역을 구하여, 보여준다

    // 그 외 보여줄 수 있는 데이터가 무엇이 있을지 생각해본다
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="관리자페이지">
    <meta property="og:title" content="ego lego" />
    <meta property="og:description" content="활동적인 아웃도어 라이프스타일" />
    <title>관리자페이지</title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://kit.fontawesome.com/8451689280.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- 메뉴바 -->
    <nav class="navbar">
        <div class="navbar__logo">
            <!-- <i class="fab fa-html5"></i> -->
            <a href="/index.php">ego lego</a>
        </div>

        <ul class="navbar__menu">
            <li><a href="board.php">자유게시판</a></li>
            <li><a href="news.php">관련뉴스</a></li>
            <li><a href="http://ego-lego.site:3000/open_chat.html">오픈채팅</a></li>
            <!-- <li><a href="">Menu4</a></li> -->
        </ul>

        <ul class="navbar__links">
            <?php
                if ($login_session) {
                    echo "<li><span style='color:white'>{$_SESSION['name']} 님</span></li>";
                    echo "<li><a href='logout_session.php'>로그아웃</a></li>";
                } else {
                    echo "<li><a href='signin.php'>로그인</a></li>";
                    echo "<li><a href='signup.php'>회원가입</a></li>";
                }
            ?>
        </ul>
    </nav>

    <!-- 관리자 통계 -->
</body>
</html>