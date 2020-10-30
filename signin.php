<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signin.css">
    <script src="https://kit.fontawesome.com/8451689280.js" crossorigin="anonymous"></script>
    <title>Sign In</title>
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

    <!-- 로그인 박스 -->
    <div class="sign-in">
        <header class="header">
            <h1>로그인</h1>
        </header>
        <form class="form" action="login.php" method="post">
            <span class="form__text">id</span>
            <input name="email" type="email" maxlength="40" class="form__input" id="email">
            <span class="form__text email-rule" id="testid">올바른 이메일을 입력해주세요</span>
            <span class="form__text">password</span>
            <input name="password" type="password" minlength="8" maxlength="20" class="form__input" id="password">
            <button name="submit" type="button" class="form__button" id="submit">로그인</button>
        </form>

        <script>
            // 정규표현식을 이용하여 올바른 이메일 양식인지 확인하여 유저에게 전달한다
            var emailRule = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
            var inputEmail = document.querySelector('#email');
            inputEmail.addEventListener("keyup", checkEmail);

            function checkEmail() {
                const email = inputEmail.value;
                const checkRule = emailRule.test(email)
                
                if (email.length > 0) {
                    if (checkRule==true) {
                        document.querySelector('.email-rule').style.visibility = "hidden";
                        return true;
                    } else {
                        document.querySelector('.email-rule').style.visibility = "visible";
                        return false;
                    }
                } else {
                    document.querySelector('.email-rule').style.visibility = "hidden";
                }
            }
            
            // 올바른 이메일 양식, 비밀번호 길이를 입력했을때, 로그인 버튼을 활성화한다
            const submitButton = document.querySelector('#submit');
            submitButton.addEventListener("click", checkInput);
            function checkInput() {
                const  statusEmail = checkEmail();
                const passwordLength = document.querySelector('#password').value.length;

                if (statusEmail == true && passwordLength >= 8) {
                    submitButton.type = "submit";
                }
            }
        </script>
    </div>
</body>

</html>