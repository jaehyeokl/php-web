<?php 
  include 'login_session.php';
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="메인페이지">
    <meta property="og:title" content="ego lego" />
    <meta property="og:description" content="활동적인 아웃도어 라이프스타일" />
    <title>메인</title>
    <link rel="stylesheet" href="css/index.css">
    <script src="https://kit.fontawesome.com/8451689280.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.0.2/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.0.2/firebase-analytics.js"></script>

    <script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyDU51kZHJ6wKJt_iVYnFVN19O-5Emcsj9M",
        authDomain: "ego-lego-c8c1e.firebaseapp.com",
        databaseURL: "https://ego-lego-c8c1e.firebaseio.com",
        projectId: "ego-lego-c8c1e",
        storageBucket: "ego-lego-c8c1e.appspot.com",
        messagingSenderId: "694569032238",
        appId: "1:694569032238:web:a5c40ca79d5a599816ddbf",
        measurementId: "G-F0QY94TSD3"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
    </script>
    
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
    <!-- <video muted autoplay>
        <source src="video/index.mp4" type="video/mp4">
        <strong>Your browser does not support the video tag.</strong>
    </video> -->
</body>


</html>