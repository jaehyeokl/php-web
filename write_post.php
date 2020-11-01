<?php 
  include 'login_session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>글쓰기</title>
    <link rel="stylesheet" href="css/write_post.css">
    <script src="https://kit.fontawesome.com/8451689280.js" crossorigin="anonymous"></script>
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

    <!-- 게시글 작성 -->
    <form class="write-post" action="uproad_post.php" method="post">
        <h1>자유게시판</h1>
        <input class="write_title"type="text" name="title" placeholder="제목을 작성해주세요" maxlength="45">
        <textarea id="summernote" class="write_contents" name="contents_text"></textarea>
        <input class="write_submit" type="submit" value="등록">
    </form> 

    <!-- summernote 설정 -->
    <script>
        $('#summernote').summernote({
            height : 400,
            maxHeight : 400,
            minHeight : 400,
            focus : true,
            lang : 'ko-KR',
            callbacks: {
                // 업로드한 이미지를 Base 64 인코딩 형태가 아닌 파일자체를 서버에 저장하기 위해서
                // 이미지 업로드 직후에 작동하는 callback 메소드인 onImageUpload 에  
                // 서버에 이미지를 파일로 저장하는 메소드(sendFile)을 override 한다
                onImageUpload : function(files, editor, welEditable) {
                    console.log('image upload:', files);
                    sendFile(files[0], editor, welEditable);
                }
            },

            // 툴바에 들어갈 들어갈 기능 설정
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                // ['para', ['ul', 'ol', 'paragraph']],
                // ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                // ['view', ['fullscreen', 'codeview', 'help']],
            ],

            popover: {
                image: [
                    // 첨부한 이미지 리사이즈 금지하기 위한 설정
                    // ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                    // ['float', ['floatLeft', 'floatRight', 'floatNone']],
                    // ['remove', ['removeMedia']]
                ],
                link: [
                    ['link', ['linkDialogShow', 'unlink']]
                ],
                table: [
                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                ],
                air: [
                    ['color', ['color']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']]
                ]
            }
        });

        // ajax 를 이용하여 이미지(file)을 서버에 전달(POST) 한다
        // 파일은 이미지를 서버 내 특정 폴더에 저장하는 기능을 수행하는
        // url(save_board_image.php) 으로 전달된다
        function sendFile(file, editor, welEditable) {
            data = new FormData();
            data.append("file", file);
            
            $.ajax({
                url: "save_board_image.php",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                // url(save_board_image.php) 로 파일 전달이 완료됐을때
                // summernote 이미지 업로드 API 를 이용하여 서버에 '저장된' 이미지를 게시판에 입력
                success: function(data) {
                    // alert(data);
                    // API : $('#summernote').summernote('insertImage', url, filename);
                    // 에디터에 img 태그로 저장을 하기 위함
                    var image = $('<img>').attr('src', '' + data);
                    $('#summernote').summernote("insertNode", image[0]);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus+" "+errorThrown);
                }
            });
        }
    </script> 
</body>
</html>