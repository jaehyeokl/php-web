<?php 
  include 'login_session.php';
?>

<?php
    // news 데이터 불러오기
    $json_string_news = file_get_contents("tourlist.json");
    // JSON문자열을 배열로 변환
    $array_news = json_decode($json_string_news, true);
    // var_dump($array_news);
    foreach($array_news as $news) {
        $news_tag = $news_tag."<li><a href='".$news[link]."'>"."<span class='title'>".$news[title]."</span>"."<span class='content'>".$news[content]."</span></a></li>";
    }
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="관련뉴스">
    <meta property="og:title" content="ego lego" />
    <meta property="og:description" content="활동적인 아웃도어 라이프스타일" />
    <title>관련뉴스</title>
    <link rel="stylesheet" href="css/news.css">
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

    <!-- 뉴스 목록 -->
    <div class="news">
        <h2>관련 뉴스</h2>
        <ul>
            <?= $news_tag ?>
        </ul>
    </div>
    
</body>
</html>