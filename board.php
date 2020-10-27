<?php
    // 데이터베이스에 저장된 자유게시판의 게시글 목록을 불러오기
    // DB 연결
    $mysqli = mysqli_connect("localhost", "root", "wodha", "web");

    // SQL문 전송 및 오류확인
    // 최근 작성한 글이 가장 위에 나타나도록 id의 내림차순으로 데이터를 불러온다
    $sql = "SELECT * FROM general_board ORDER BY id DESC";
    $result = mysqli_query($mysqli, $sql);
    
    while ($row = mysqli_fetch_array($result)) {
        $listId = "<td class='index'>{$row['id']}</td>";

        // <a> 태그의 링크에 게시글의 id를 파라미터로 추가한다
        // 게시글이 고유한 주소를 가지게 하면서, id와 일치하는 게시글의 데이터만을 가져오기 위해
        $listTitle = "<td class='title'><a href='view_post.php?id={$row['id']}'>{$row['title']}</a></td>";
        $listCreated = "<td class='created'>{$row['created']}</td>";

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
        <table class="board__list">
            <thead class="board__header">
                <th scope="col" class="board__header index"></th>
                <th scope="col" class="board__header title">제목</th>
                <!-- <th scope="col" class="board__header user">작성자</th> -->
                <th scope="col" class="board__header created">작성일</th>
            </thead>
            <tbody class="board__body">
                <!-- 게시글 리스트 업로드-->
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
        <a href="write_post.php" class="board__button_write">글쓰기</a>
    </div>
</body>
</html>