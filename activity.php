<?php 
  include 'login_session.php';
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="추천활동">
    <meta property="og:title" content="ego lego" />
    <meta property="og:description" content="활동적인 아웃도어 라이프스타일" />
    <title>추천 활동</title>
    <link rel="stylesheet" href="css/activity.css">
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
            <li><a href="activity.php">추천활동</a></li>
            <li><a href="">Menu3</a></li>
            <li><a href="">Menu4</a></li>
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

    <!-- 추천 활동 -->
    <section class="section__body">
        <header class="section__header">
            <h2>추천 활동</h2>
            <a href="">글쓰기</a>
        </header>
        <!-- 게시글 목록 -->
        <section class="section__list">
            <ul>
                <li>
                    <a href="#" class="thumbnail">
                        <img src="/images/cedebb6e872f539bef8c3f919874e9d7.jpg" alt>
                    </a>
                    <div class="contents">
                        <h4 class="contents__title">
                            <a href="#">타이틀을 작성</a>
                        </h4>
                        <p class="contents__preview">
                            <a href="#">컨텐츠 내용 미리보기, 미리보기내용입니다ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</a>
                        </p>
                        <span class="contents__info">
                            <em>카테고리 | </em>
                            <em>작성일</em>
                        </span>
                    </div>
                    <div class="thumb">
                        <i class="fas fa-heart"></i>
                        <span>99</span>
                    </div>
                </li>


                <li>
                    <a href="#" class="thumbnail">
                        <img src="/images/cedebb6e872f539bef8c3f919874e9d7.jpg" alt>
                    </a>
                    <div class="contents">
                        <h4 class="contents__title">
                            <a href="#">타이틀을 작성</a>
                        </h4>
                        <p class="contents__preview">
                            <a href="#">컨텐츠 내용 미리보기, 미리보기내용입니다ddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd</a>
                        </p>
                        <span class="contents__info">
                            <em>카테고리 | </em>
                            <em>작성일</em>
                        </span>
                    </div>
                    <div class="thumb">
                        <i class="fas fa-heart"></i>
                        <span>99</span>
                    </div>
                </li>
            </ul>
        </section>
        <!-- 하단 페이지 버튼 -->
        <div class="pages">
            <ul>
                <li>1</li>
            </ul>
        </div>

        

    </section>

</body>
</html>