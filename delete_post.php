<!-- 게시글 삭제 -->
<!-- 실제 데이터 삭제가 아닌 DB에서 삭제상태(del) true 변경 -->
<?php 
    include 'login_session.php';
?>

<?php    
    // DB 연결
    include_once("../file/dbconnect.php");

    try {
        if ($_POST['mode'] == 'delete') {
            // 삭제 요청 확인 후
            $statement = $conn->prepare("UPDATE general_board SET del = 1 WHERE id = :id");
            $statement->bindParam(":id", $_POST['postId']);
            $statement->execute();
        }
        
        // echo "New records created successfully";
    } catch (PDOException $ex) {
        echo "failed! : ".$ex->getMessage()."<br>";
    }
    $conn = null;

    header("Location: https://ego-lego.site/board.php");
    die();
?>