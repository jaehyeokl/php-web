<?php
    // DB 연결
    include_once("../file/dbconnect.php");

    try {
        // 페이징
        $get_page_statement = $conn->query("SELECT * FROM general_board");
        // ex) http://192.168.102.129/board.php?page=1
        // 페이지번호를 파라미터로 가지는 링크를 부여함으로써 페이지를 나눈다
        // 먼저 총 데이터(게시글)의 개수를 통해 페이지 수를 구한다
        $total_row = $get_page_statement->rowCount();
        // 게시판 한페이지에 보여질 게시글 수
        $post_num = 10;
        // 전체 페이지의 수를 구한다
        if ($total_row % $post_num == 0) {
            $total_page = $total_row / $post_num;
        } else {
            $total_page = ($total_row / $post_num)+1;
        }
        // 몫이 소수점일때 몫(페이지)을 정수로 구하기 위해서 int 형변환
        $total_page = (int) $total_page;
        // 페이지 수만큼 페이지 이동 버튼을 생성
        $check_page = 1;
        while ($check_page <= $total_page) {
            $page_button = $page_button."<a href='board.php?page=$check_page'>$check_page</a>";
            $check_page++;
        }


        // 페이지 게시글 불러오기
        // ex) http://192.168.102.129/board.php?page=1
        // url 의 page 파라미터를 이용해서(GET) 해당 페이지에 보여질 데이터만 불러오기
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            // 자유게시판에 처음 들어왔을때는 파라미터가 없기때문에 의도적으로 첫페이지를 부여한다
            $page = 1;
        }
        // 최근 작성한 글이 가장 위에 나타나도록 id의 내림차순으로 데이터를 불러온다
        $get_post_statement = $conn->prepare("SELECT * FROM general_board ORDER BY id DESC LIMIT :start_point, :post_num");
        // SQL문 - LIMIT 시작(row), 불러올 개수
        // 입력한 시작 지점(start_point를 구하기)
        $start_point = ($page - 1)*$post_num;
        // prepare statement 에 바인드될 변수가 정수일때는 PDO::PARAM_INT 인자에 넣어주어야한다
        $get_post_statement->bindParam(':start_point', $start_point, PDO::PARAM_INT);
        $get_post_statement->bindParam(':post_num', $post_num, PDO::PARAM_INT);
        $get_post_statement->execute();

        // 불러온 게시글을 테이블에 반영한다
        while ($row = $get_post_statement->fetch()) {
            $listId = "<td class='index'>{$row['id']}</td>";
            // <a> 태그의 링크에 게시글의 id를 파라미터로 추가한다
            // 게시글이 고유한 주소를 가지게 하면서, id와 일치하는 게시글의 데이터만을 가져오기 위해
            $listTitle = "<td class='title'><a href='view_post.php?id={$row['id']}'>{$row['title']}</a></td>";
            $listCreated = "<td class='created'>{$row['created']}</td>";

            $totalRow = $totalRow."<tr>".$listId.$listTitle.$listCreated."<tr>";
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
    <link rel="stylesheet" href="css/board.css">
    <script src="https://kit.fontawesome.com/8451689280.js" crossorigin="anonymous"></script>
    <title>자유게시판</title>
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
            <!-- <button>이전</button> -->
            <!-- 페이지 수에따라 페이지 버튼이 나타나도록 구현한다 -->
            <?= $page_button ?>
            <!-- <button>다음</button> -->
        </div>
        <a href="write_post.php" class="board__button_write">글쓰기</a>
    </div>
</body>
</html>