<?php 
  include 'login_session.php';
?>

<?php
    // DB 연결
    include_once("../file/dbconnect.php");

    try {
        // http://192.168.102.129/view_post.php?id=59
        // id(url 파라미터)를 이용하여 게시글의 데이터를 불러온다
        $statement = $conn->prepare("SELECT * FROM general_board WHERE id = :post_id");
        $statement->bindParam(':post_id', $_GET['id'], PDO::PARAM_INT);
        $statement->execute();
            
        $row = $statement->fetch();
        $creater = $row['creater'];
        $title = $row['title'];
        $contents_text = $row['contents_text'];
        $created = $row['created'];
        $hit = $row['hit'];
        
        // 게시글의 작성자를 닉네임으로 표시하기 위해서
        // 게시글 데이터에 저장된 (creater)을 이용해 user 데이터에서 작성자의 닉네임을 불러온다
        $name_statement = $conn->prepare("SELECT name FROM user WHERE email = :creater");
        $name_statement->bindParam(':creater', $row['creater']);
        $name_statement->execute();
        $name_row = $name_statement->fetch();
        $name = $name_row['name']; // 닉네임

        // 게시글 클릭 시 조회수 증가 (+1)
        // 로그인 세션에 저장된 계정과, 게시글의 작성자를 비교하여
        // 작성자가 본인의 게시글을 볼때는 조회수를 추가하지 않는다
        if ($_SESSION['email'] != $creater || $_SESSION['email'] == null) {
            $hit_statement = $conn->prepare("UPDATE general_board SET hit = hit + 1 WHERE id = :post_id");
            $hit_statement->bindParam(':post_id', $_GET['id'], PDO::PARAM_INT);
            $hit_statement->execute();
        }
        
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
            <div class="post__header_top">
                <a href="board.php" class="post__link_board">자유게시판 ></a>
                <i class="fas fa-ellipsis-v dropdown">
                    <a href="">수정</a>
                    <a href="">삭제</a>
                </i>
            </div>
            <h1 class="post__title"><?= $title?></h1>
            <div class="post__information">
                <span>작성자 :  <?=$name?>
                <span>작성 날짜 : <?=$created?></span>
                <span>조회수 : <?=$hit?></span>
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