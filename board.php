<?php
    // 데이터베이스에 저장된 자유게시판의 게시글 목록을 불러오기
    // DB 연결
    $mysqli = mysqli_connect("localhost", "root", "wodha", "web");


    // 페이징
    $get_page_sql = "SELECT * FROM general_board";
    $get_page_result = mysqli_query($mysqli, $get_page_sql);    
    // 페이지를 파라미터로 가지는 링크를 부여함으로써 페이지를 나눈다
    // 이후 페이지 번호에 들어갈 게시글만 불러올 수 있도록 한다
    // 그러기 위해서 먼저 총 데이터(게시글)의 개수를 통해 페이지 수를 구한다
    //$sql = "SELECT * FROM general_board ORDER BY id DESC";
    //$result = mysqli_query($mysqli, $sql);
    $total_row = mysqli_num_rows($get_page_result);
    // 한 페이지에 보여줄 게시글 수
    $post_num = 10;
    // 총 필요한 페이지 수를 구한다
    if ($total_row % $post_num == 0) {
        $total_page = $total_row / $post_num;
    } else {
        $total_page = ($total_row / $post_num)+1;
    }
    // 몫이 소수점일때 몫을 정수로 구하기 위해서 int 형변환
    $total_page = (int) $total_page;
    // 페이지로 이동할 수 있는 버튼을 만들어준다
    $check_page = 1;
    while ($check_page <= $total_page) {
        $page_button = $page_button."<a href='board.php?page=$check_page'>$check_page</a>";
        $check_page++;
    }


    // 페이지 게시글 불러오기
    // URI 에 파라미터로 페이지번호를 추가하였기 때문에 
    // 페이지번호를 활용(GET)하여 데이터를 불러올 수 있도록 한다
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        // 자유게시판에 처음 들어왔을때는 파라미터가 없기때문에 의도적으로 첫페이지를 부여한다
        $page = 1;
    }
    // 최근 작성한 글이 가장 위에 나타나도록 id의 내림차순으로 데이터를 불러온다
    $get_post_sql = "SELECT * FROM general_board ORDER BY id DESC";
    // LIMIT 에 추가할 불러올 데이터의 시작 위치
    $start_point = ($page - 1)*$post_num;
    $get_post_sql = $get_post_sql." LIMIT $start_point ,$post_num";
    $get_post_result = mysqli_query($mysqli, $get_post_sql);    
    // 불러온 게시글을 테이블에 반영한다
    while ($row = mysqli_fetch_array($get_post_result)) {
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
                <?= $totalRow ?>
            </tbody>
        </table>
        <div class="board__page">
            <button>이전</button>
            <!-- 페이지 수에따라 페이지 버튼이 나타나도록 구현한다 -->
            <?= $page_button ?>
            <button>다음</button>
        </div>
        <a href="write_post.php" class="board__button_write">글쓰기</a>
    </div>
</body>
</html>