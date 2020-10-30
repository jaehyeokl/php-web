<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
    <link rel="stylesheet" href="css/write_post.css">
    <script src="https://kit.fontawesome.com/8451689280.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- 메뉴바 -->
    <nav class="navbar">
        <div class="navbar__logo">
            <i class="fab fa-html5"></i>
            <a href="/index.php">WebSite</a>
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

    <!-- 게시글 작성 -->
    <form class="write-post" action="uproad_post.php" method="post">
        <h4>자유게시판</h4>
        <input class="write_title"type="text" name="title" placeholder="제목을 작성해주세요" maxlength="45">
        <textarea class="write_contents" name="contents_text" placeholder="게시글을 작성해주세요"></textarea>
        <input class="write_submit" type="submit" value="등록">
    </form> 
    <script>
        
    </script>    
</body>
</html>