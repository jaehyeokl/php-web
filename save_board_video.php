<?php
    // write_post.php(참조)에서 파일을 전달받아 서버 내 디렉토리에 저장한다
    if ($_FILES['video']['name']) {
        if (!$_FILES['video']['error']) {
            // 파일 이름
            $name = md5(rand(100, 200));
            $ext = explode('.', $_FILES['video']['name']);
            $filename = $name . '.' . $ext[1];
            // 전달받은 파일을 지정한 위치에 저장            
            $destination = './video/' . $filename;
            $uploadedFile = $_FILES["video"]["tmp_name"];
            move_uploaded_file($uploadedFile, $destination);
            echo 'video/' . $filename;
        } else {
            echo $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['video']['error'];
        }
    }
?>