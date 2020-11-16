<?php 
    include 'login_session.php';
?>

<?php
    // 게시글 [수정]을 통해 페이지 접근했을때
    // 수정을 위한 기존 데이터 (타이틀, 게시글)을 불러온다
    if ($_POST['mode'] === "modify") {
        // DB 연결
        include_once("../file/dbconnect.php");

        $statement = $conn->prepare("SELECT title, contents_text FROM general_board WHERE id = :id");
        $statement->bindParam(':id', $_POST['postId'], PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch();

        $title = $row['title'];
        $contents = $row['contents_text'];
    }
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="자유게시판 게시글 작성">
    <meta property="og:title" content="ego lego" />
    <meta property="og:description" content="활동적인 아웃도어 라이프스타일" />
    <title>게시글 작성</title>
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
            <!-- <i class="fab fa-html5"></i> -->
            <a href="/index.php">ego lego</a>
        </div>

        <ul class="navbar__menu">
            <li><a href="board.php">자유게시판</a></li>
            <li><a href="news.php">관련뉴스</a></li>
            <li><a href="http://ego-lego.site:3000/open_chat.html">오픈채팅</a></li>
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

    <!-- 게시글 작성 -->
    <form class="write-post" action="uproad_post.php" method="post">
        <h1>자유게시판</h1>
        <input class="write_modify" type="hidden" name="modify_post_id" value="0">
        <input class="write_title"type="text" name="title" minlength="1" placeholder="제목을 작성해주세요" maxlength="45">
        <div class="write_video">
            <i id="write_video" class="fas fa-file-video"></i>
            <input class="select_video" name= "video" type="file" accept="video/*">
            <!-- <button type="button">동영상</button> -->
            <!-- <button type="button">저장</button> -->
        </div>
        <textarea id="summernote" class="write_contents" name="contents_text"></textarea>
        <input class="write_submit" type="submit" value="등록">
    </form>

    <!-- 등록 버튼 -->
    <script>
        // 게시글 등록버튼 눌렀을때, 제목 내용 입력여부를 체크하고
        // 등록여부를 한번 더 물어본다
        const writeSubmit = document.querySelector(".write_submit");
        writeSubmit.addEventListener("click", checkInputForm);

        // 수정모드일때 버튼의 텍스트를 '수정'으로 변경
        if ('<?=$_POST['mode']?>' == 'modify') {
            writeSubmit.value = '수정';
        }

        function checkInputForm() {
            const titleLength = document.querySelector(".write_title").value.length;
            const contentsLength = document.querySelector(".write_contents").value.length;

            // 공백 체크
            if (!titleLength > 0) {
                event.preventDefault();
                event.stopPropagation();
                alert("제목을 입력해주세요")
            } else if (contentsLength < 2) {
                event.preventDefault();
                event.stopPropagation();
                alert("내용을 작성해주세요")
            } else {
                // 업로드 확인 안내 
                var upload = confirm("게시글을 업로드 하시겠습니까?");
                if (upload) {
                    // alert("게시글을 등록하였습니다")
                } else {
                    event.preventDefault();
                    event.stopPropagation();
                }
            }
        }
    </script>

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

    <!-- 썸머노트에 비디오파일 올리기 -->
    <script>
        // 파일 업로드 버튼 이미지버튼으로 대체하기
        document.querySelector("#write_video").addEventListener("click", selectVideo);
        function selectVideo() {
            document.querySelector(".select_video").click();
        }

        // 파일 업로드 시 서버에 파일을 저장
        document.querySelector(".select_video").addEventListener("change", sendVideo);

        function sendVideo() {
            fileVideo = new FormData(document.querySelector(".write-post"));
            
            $.ajax({
                url: "save_board_video.php",
                data: fileVideo,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function(data) {
                    if (data === "") {
                        // alert(data);
                        alert("5M 이하의 동영상만 업로드 할 수 있습니다")
                    } else {
                        // 동영상태그에 컨트롤러, 너비 지정
                        var video = $('<video>').attr({'src':'' + data, 'controls':true, 'width':'800'});
                        $('#summernote').summernote("insertNode", video[0]);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus+" "+errorThrown);
                }
            });
        }

        // XMLHttpRequest 직접 구현하여 FormData 전달하였음,
        // 전달 완료 후 요청페이지에서 처리한 값을 다시 가져오는 것 구현하지 않고
        // jQuery 의 ajax를 사용하였음
        // function sendVideo() {
        //     var xhr = new XMLHttpRequest();
        //     var formData = new FormData(document.querySelector(".write-post"));
        
        //     xhr.onload = function() {
        //         if (xhr.status === 200 || xhr.status === 201) {
        //             // 요청 완료
        //             console.log(xhr.responseText);
        //             console.log("성공");
        //         } else {
        //             // 요청 실패
        //             console.error(xhr.responseText);
        //             console.log("실패");
        //         }
        //     };

        //     xhr.open('POST', 'http://54.180.215.159/phptest.php');
        //     xhr.send(formData);
        // }
    </script>

    <!-- 수정 모드일때 -->
    <script>    
        if ('<?=$_POST['mode']?>' == 'modify') {
            // 게시글의 입력값을 전달받는 action(upload.php)에서 
            // 특정 게시글 수정에 대한 작업을 처리할 수 있도록 post Id 를 전달한다
            document.querySelector(".write_modify").value = '<?=$_POST['postId']?>';
            
            // 기존 타이틀 입력
            var title = '<?= $title?>';
            document.querySelector(".write_title").value = title;
            // 기존 내용(썸머노트)
            var contents = '<?= $contents?>';
            $('#summernote').summernote('pasteHTML', contents);
        }
    </script>
</body>
</html>