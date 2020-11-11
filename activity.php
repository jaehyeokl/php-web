<?php 
  include 'login_session.php';
?>

<?php
    // DB 연결
    include_once("../file/dbconnect.php");

    try {
        // 게시판 한페이지에 보여질 게시글 수
        $post_num = 10;

        // 삭제되지 않은 전체 게시글의 수 ($total_row)
        $get_page_statement = $conn->query("SELECT * FROM activity_board WHERE del = 0");
        $total_row = $get_page_statement->rowCount();
        
        // 게시글을 페이징처리하기 위해 필요한 페이지 수 ($total_page)
        // 몫이 소수점일때 몫(페이지)을 정수로 구하기 위해서 int 형변환
        if ($total_row % $post_num == 0) {
            $total_page = $total_row / $post_num;
        } else {
            $total_page = ($total_row / $post_num)+1;
        }

        $total_page = (int) $total_page;
        
        // 현재 페이지는 url의 파라미터에서 확인(GET) 할 수 있다 ex) www.url?page=1 
        // 현재 페이지에 보여질 게시글을 불러오기
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            // 자유게시판에 처음 들어왔을때는 파라미터가 없기때문에 의도적으로 첫페이지를 부여한다
            $page = 1;
        }
        
        // 최근 작성한 글이 가장 위에 나타나도록 id의 내림차순으로 데이터를 불러온다
        // $get_post_statement = $conn->prepare("SELECT activity_board.*, user.name FROM activity_board FULL OUTER JOIN email WHERE del = 0 ORDER BY id DESC LIMIT :start_point, :post_num");
        // // SQL문 - LIMIT 시작(row), 불러올 개수
        // // 입력한 시작 지점(start_point를 구하기)
        // $start_point = ($page - 1)*$post_num;
        // // prepare statement 에 바인드될 변수가 정수일때는 PDO::PARAM_INT 인자에 넣어주어야한다
        // $get_post_statement->bindParam(':start_point', $start_point, PDO::PARAM_INT);
        // $get_post_statement->bindParam(':post_num', $post_num, PDO::PARAM_INT);
        // $get_post_statement->execute();

        // // 불러온 게시글을 테이블에 반영한다
        // while ($row = $get_post_statement->fetch()) {
        //     // 게시글의 작성자를 닉네임으로 표시하기 위해서
        //     // 게시글 데이터에 저장된 (creater)을 이용해 user 데이터에서 작성자의 닉네임을 불러온다
        //     $name_statement = $conn->prepare("SELECT name FROM user WHERE email = :creater");
        //     $name_statement->bindParam(':creater', $row['creater']);
        //     $name_statement->execute();
        //     $name_row = $name_statement->fetch();
        //     $name = $name_row['name']; // 닉네임

        //     // 작성일 포맷 (년.월.일)
        //     // 당일 작성한 글은 시간만 표기되도록 한다 (시:분)
        //     $time_today = date("Y.m.d");
        //     $time_created = date("Y.m.d", strtotime($row['created']));
        //     if($time_today === $time_created) {
        //         $time_created = date("H:i", strtotime($row['created']));
        //     }
            
        //     $listId = "<td class='index'>{$row['id']}</td>";
        //     // <a> 태그의 링크에 게시글의 id를 파라미터로 추가한다
        //     // 게시글이 고유한 주소를 가지게 하면서, id와 일치하는 게시글의 데이터만을 가져오기 위해
        //     $listTitle = "<td class='title'><a href='view_post.php?id={$row['id']}'>{$row['title']}</a></td>";
        //     $listCreater = "<td class='creater'>{$name}</td>";
        //     $listCreated = "<td class='created'>{$time_created}</td>";
        //     $listHit = "<td class='created'>{$row['hit']}</td>";

        //     $totalRow = $totalRow."<tr>".$listId.$listTitle.$listCreater.$listCreated.$listHit."<tr>";
        // }

        
    } catch (PDOException $ex) {
        echo "failed! : ".$ex->getMessage()."<br>";
    }
    $conn = null;
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
            <!-- <li><a href="">Menu3</a></li>
            <li><a href="">Menu4</a></li> -->
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
            <a href="write_activity.php">글쓰기</a>
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
                            <em>작성자 | </em>
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
                            <em>작성자 | </em>
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