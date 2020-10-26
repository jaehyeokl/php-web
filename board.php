<?php
    // 데이터베이스에 저장된 자유게시판의 게시글 목록을 불러오기

    echo "<p></p>";
    // DB 연결
    $mysqli = mysqli_connect("localhost", "root", "wodha", "web");

    // SQL문 전송 및 오류확인
    $result = mysqli_query($mysqli, $sql);

    $sql = "SELECT * FROM general_board";
    $result = mysqli_query($mysqli, $sql);
    //var_dump($result);
    // var_dump($result->num_rows); // 행(row) 몇개인지 확인할 수 있다

    while ($row = mysqli_fetch_array($result)) {
        $listId = "<td>{$row['id']}</td>";
        $listTitle = "<td><a href='#'>{$row['title']}</a></td>";
        $listCreated = "<td>{$row['created']}</td>";

        $totalRow = $totalRow."<tr>".$listId.$listTitle.$listCreated."<tr>";
    }

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
                <!-- <th scope="col" class="board__header user">작성자</th> -->
                <th scope="col" class="board__header date">작성일</th>
            </thead>
            <tbody class="board__body">
                <?php echo $totalRow ?>
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