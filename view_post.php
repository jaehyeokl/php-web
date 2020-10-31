<?php 
  include 'login_session.php';
?>

<?php
    // DB 연결
    include_once("../file/dbconnect.php");

    try {
        // 게시글의 post id 가 포함된 url 에서 id 를 저장한다
        // 저장해둔 게시글의 id 를 sql문에 이용해서 해당 게시글의 데이터만 가져온다
        $statement = $conn->prepare("SELECT * FROM general_board WHERE id = :post_id");
        $statement->bindParam(':post_id', $_GET['id'], PDO::PARAM_INT);
        $statement->execute();
            
        // 게시글 배열에서 필요한 데이터만 불러오기
        $row = $statement->fetch();
        $title = $row['title'];
        $contents_text = $row['contents_text'];
        $created = $row['created'];
        
    } catch (PDOException $ex) {
        echo "failed! : ".$ex->getMessage()."<br>";
    }
    $conn = null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/view_post.css">
    <script src="https://kit.fontawesome.com/8451689280.js" crossorigin="anonymous"></script>
    <title>자유게시판 - </title>
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
            <textarea id="summernote"><?= $contents_text?></textarea>
        </div>
    </div>

    <!-- summernote 설정 -->
    <script>
        $('#summernote').summernote({
            height : 400,
            maxHeight : 400,
            minHeight : 400,
            // tabsize: 2,
            focus : true,
            lang : 'ko-KR',
            // 드래그 드롭을 통해 게시글에 내용 추가되는것 확인하였음
            // 읽기전용이기 때문에 해당 기능 비활성화
            disableDragAndDrop: true,
            // 읽기전용 모든 툴바를 제거한다
            toolbar: [
                // ['style', ['style']],
                // ['font', ['bold', 'underline', 'clear']],
                // ['fontname', ['fontname']],
                // ['color', ['color']],
                // ['para', ['ul', 'ol', 'paragraph']],
                // ['table', ['table']],
                // ['insert', ['link', 'picture', 'video']],
                // ['view', ['fullscreen', 'codeview', 'help']],
            ]
        });

        // 쓰기 비활성화(읽기전용)
        // 공식문서에서는 아래 주석처리된 코드를 안내하지만 실제 작동 X
        // 아래에 있는 코드로 비활성화 구현하였음
        // $('.summernote').summernote('disable');
        $('#summernote').next().find(".note-editable").attr("contenteditable", false);
    </script> 
    
</body>
</html>