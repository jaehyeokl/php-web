<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup.css">
    <script src="https://kit.fontawesome.com/8451689280.js" crossorigin="anonymous"></script>
    <title>Sign Up</title>
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
            <li><a href="">Menu5</a></li>
        </ul>

        <ul class="navbar__links">
            <li><a href="signin.php">로그인</a></li>
            <li><a href="signup.php">회원가입</a></li>
        </ul>
    </nav>

    <!-- 회원가입 폼 -->
    <div class="sign-up">
        <header class="header">
            <h1>회원가입</h1>
        </header>
        <form class="form" action="register.php" method="post">
            <span class="form__text">e-mail</span>
            <input name="email" type="email" maxlength="40"class="form__input">
            <span class="form__text">name</span>
            <input name="name" type="text" minlength="3" maxlength="12" class="form__input">
            <span class="form__text">password</span>
            <input name="password" type="password" minlength="8" maxlength="20" class="form__input" id="password">
            <span class="form__text">confirm password</span>
            <input type="password" minlength="8" maxlength="20" class="form__input" id="confirm-password">
            <!-- span 공간을 차지하기 위해 visibility: hiddine -->
            <span class="form__text confirm-password">비밀번호가 일치하지 않습니다</span>
            <button name="submit"type="submit" class="form__button" id="submit">Sign In</button>
        </form>

        <script>
            
            // const submitButton = document.querySelector('#submit');
            // submitButton.addEventListener("click", checkInput);

            // function checkInput() {
                
            // }
            // 비밀번호와 이메일, 이름이 올바른 형태일때 회원가입 버튼을 누를 수 있게
            
            // 비밀번호, 비밀번호 확인 일치 여부 확인
            const inputPassword = document.querySelector('#password');
            const inputConfirmPassword = document.querySelector('#confirm-password');
            inputPassword.addEventListener("keyup", comparePassword);
            inputConfirmPassword.addEventListener("keyup", comparePassword);

            function comparePassword() {
                var confirmPassword = document.querySelector('#confirm-password').value;
                var password = document.querySelector('#password').value;

                if (confirmPassword === password) {
                    document.querySelector('.confirm-password').style.visibility = "hidden";
                } else {
                    document.querySelector('.confirm-password').style.visibility = "visible";
                }
            }
        </script>

        <!-- <?php 
            // 유저가 입력한 비밀번호를 바로 post로 전달하게 되면, 유저가 입력한 값이 외부에 노출된다
            // 그렇게 때문에 해당 페이지에서 바로 암호화하여, 암호화된 비밀번호를 전달(post)한다
            // 유저가 기존에 타이핑한 비밀번호는 더이상 사용되지 않는다

            // 유저가 입력한 비밀번호를 가져온다
            echo "
                <script>
                    const submitButton = document.querySelector('#submit');
                    submitButton.onclick = function() {
                        const inputPassword = document.querySelector('#password');
                        const userPassword = inputPassword.value;
                        
                    }
                </script>
            ";



            // if (array_key_exists('submit', $_POST)) {
            //     $salt = '$2a$07$R.gJb2U2N.FmZ4hPp1y2CN$';
            //     $passwd = crypt("password", $salt);
            //     $query = sprintf("INSERT INTO USER (email, passwd, cdate) VALUES ('user_email','$passwd',now())");
            // }
        ?> -->

        <!-- <?php
            // 유저가 로그인버튼을 눌렀을때, 비밀번호 input 태그의 value 를 암호화된 비밀번호로 변경
            // 유저의 비밀번호가 아닌 암호화된 비밀번호가 전송된다
            echo "
                <script>
                    const submitButton = document.querySelector('#submit');
                    submitButton.onclick = function() {
                        const inputPassword = document.querySelector('#password');
                        inputPassword.value = 'aaaaaaaaaaaaaaaaaaabbbb';
                    }
                </script>
            ";
        ?> -->
    </div>

</body>

</html>