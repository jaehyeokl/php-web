<?php
    include("./dbconnect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/board.css">
    <script src="https://kit.fontawesome.com/8451689280.js" crossorigin="anonymous"></script>
    <title>자유게시판</title>
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

    <!-- 자유게시판 -->
    <div class="board">
        <h2>자유게시판</h2>
        <a href="write_post.php" class="board__button_write">글쓰기</a>
        <table class="board__list">
            <thead class="board__header">
                <th scope="col" class="board__header index"></th>
                <th scope="col" class="board__header title">제목</th>
                <th scope="col" class="board__header user">작성자</th>
                <th scope="col" class="board__header date">작성일</th>
            </thead>
            <tbody class="board__body">
                <?php
                // tr 태그에 td 태그 + th 활용하여 게시글 타이틀 보여주기
                ?>
                <tr>
                    <td>3</td>
                    <td>3</td>
                    <td>3</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>3</td>
                    <td>3</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>3</td>
                    <td>3</td>
                    <td>3</td>
                </tr>
            </tbody>
        </table>
        <div class="board__page">
            <button>이전</button>
            <?php
            // 페이지 수에따라 페이지 버튼이 나타나도록 구현한다
            ?>
            <button>다음</button>
        </div>
    </div>

    <div class="write-contents">
        
    </div>
</body>
</html>