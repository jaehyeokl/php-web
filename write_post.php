<?php 
  include 'login_session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
    <link rel="stylesheet" href="css/write_post.css">
    <script src="https://kit.fontawesome.com/8451689280.js" crossorigin="anonymous"></script>
    <!-- summernote 사용 위한 bootstrap, jquery -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.js"></script>
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

    <!-- 게시글 작성 -->
    <form class="write-post" action="uproad_post.php" method="post">
        <h1>자유게시판</h1>
        <input class="write_title"type="text" name="title" placeholder="제목을 작성해주세요" maxlength="45">
        <textarea id="summernote" class="write_contents" name="contents_text"></textarea>
        <input class="write_submit" type="submit" value="등록">
    </form> 

    <!-- summernote 설정 -->
    <script>
        $('#summernote').summernote({
            height : 400,
            maxHeight : 400,
            minHeight : 400,
            // tabsize: 2,
            focus : true,
            lang : 'ko-KR',
            // default
            // toolbar: [
            //     ['style', ['style']],
            //     ['font', ['bold', 'underline', 'clear']],
            //     ['fontname', ['fontname']],
            //     ['color', ['color']],
            //     ['para', ['ul', 'ol', 'paragraph']],
            //     ['table', ['table']],
            //     ['insert', ['link', 'picture', 'video']],
            //     ['view', ['fullscreen', 'codeview', 'help']],
            // ]
        });
    </script> 
</body>
</html>