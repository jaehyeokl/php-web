<?php
    // write_post.php(참조)에서 파일을 전달받아 서버 내 디렉토리에 저장한다
    if ($_FILES['file']['name']) {
        if (!$_FILES['file']['error']) {
            // 파일 이름
            $name = md5(rand(100, 200));
            $ext = explode('.', $_FILES['file']['name']);
            $filename = $name . '.' . $ext[1];
            // 전달받은 파일을 지정한 위치에 저장            
            $destination = './images/' . $filename;
            $uploadedFile = $_FILES["file"]["tmp_name"];
            move_uploaded_file($uploadedFile, $destination);
            echo 'images/' . $filename;
        } else {
          echo  $message = 'Ooops! Your upload triggered the following error:  '.$_FILES['file']['error'];
        }
    }

    // function resize() {
    //     //리사이즈
    //     define('__Limit_Width',800);  // 원하는 가로길기 limit값 
    //     define('__Limit_Height',500)
     
    //     $imgsize = getimagesize($uploadedFile);
    //     if ($imgsize[0] > __Limit_Width || $imasize[1] > __Limit_Height) {
    //         if($imgsize[0]<$imgsize[1]) { 
    //             // 가로가 세로보다 클경우 
    //             $sumw = (100*__Limit_Height)/$imgsize[1]; 
    //             $img_width = ceil(($imgsize[0]*$sumw)/100); 
    //             $img_height = __Limit_Height; 
    //         } else { 
    //             // 세로가 가로보다 클경우 
    //             $sumh = (100*__Limit_Width)/$imgsize[0]; 
    //             $img_height = ceil(($imgsize[1]*$sumh)/100); 
    //             $img_width = __Limit_Width; 
    //         } 
    //     } else { 
    //         // limit보다 크지 않는 경우는 원본 사이즈 그대로..... 
    //         $img_width = $imgsize[0]; 
    //         $img_height = $imgsize[1]; 
    //     } 
    // }
?>