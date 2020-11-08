<!-- 자유게시판에서 글작성(write_post.php) 업로드 -->
<!-- 작성된 글을 업로드,수정 할때 실행되며, 데이터베이스에 글을 저장한다-->
<?php 
    include 'login_session.php';
?>

<?php    
    // DB 연결
    include_once("../file/dbconnect.php");

    // modify_id 로 전달받을 수 있는 값
    // (새 게시글일때 = 0 / 게시글 수정일때 = 게시글 id) 
    $modify_id = $_POST['modify_post_id'];

    try {
        if ($modify_id == 0) {
            // 새 게시글 작성일때
            // prepare statement
            $statement = $conn->prepare("INSERT INTO general_board (creater, title, contents_text, created) 
            VALUES (:creater, :title, :contents_text, :created)");
            $statement->bindParam(':creater', $_SESSION['email']); // 세션에 저장된 email 을 작성자로 추가
            $statement->bindParam(':title', $title);
            $statement->bindParam(':contents_text', $contents_text);
            $statement->bindParam(':created', $created);

            // 데이터 입력 후 실행
            $title = $_POST['title'];
            $contents_text = $_POST['contents_text'];
            // MYSQL 의 NOW() 처럼 현재시간을 구하는 함수
            // 한국시간 가져오기 위해 php.ini 파일의 date.timezone 을 Asia/Seoul로 설정하였음
            $created = date('Y-m-d H:i:s');
            $statement->execute();

        } else {
            // 게시글 수정일때 
            $statement = $conn->prepare("UPDATE general_board SET title = :title, contents_text = :contents_text 
            WHERE id = :id");
            $statement->bindParam(':title', $title);
            $statement->bindParam(':contents_text', $contents_text);
            $statement->bindParam(':id', $modify_id, PDO::PARAM_INT);
            // 데이터 입력 후 실행
            $title = $_POST['title'];
            $contents_text = $_POST['contents_text'];
            $statement->execute();
        }
        
        // echo "New records created successfully";
    } catch (PDOException $ex) {
        echo "failed! : ".$ex->getMessage()."<br>";
    }
    $conn = null;

    // 자유게시판으로 리다이렉트
    header("Location: http://54.180.215.159/board.php");
    die();
?>