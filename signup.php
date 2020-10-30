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
            <input name="email" type="email" maxlength="40"class="form__input" id="email">
            <span class="form__text email-rule" id="testid">올바른 이메일을 입력해주세요</span>
            <span class="form__text">name</span>
            <input name="name" type="text" minlength="3" maxlength="12" class="form__input">
            <span class="form__text">password</span>
            <input name="password" type="password" minlength="8" maxlength="20" class="form__input" id="password">
            <span class="form__text">confirm password</span>
            <input type="password" minlength="8" maxlength="20" class="form__input" id="confirm-password">
            <!-- span 공간을 차지하기 위해 visibility: hiddine -->
            <span class="form__text confirm-password">비밀번호가 일치하지 않습니다</span>
            <button name="submit"type="button" class="form__button" id="submit">가입</button>
        </form>

        <script>
            // 유저가 입력한 정보(이메일/패스워드)가 올바른 양식인지 판단하여 유저에게 알려준다
            // 올바른 양식으로 입력했을때, 회원가입 버튼이(submit) 활성화되도록 하여
            // 양식에 맞는 데이터로만 회원가입 될 수 있도록 구현

            // 정규표현식을 이용하여 올바른 이메일 양식인지 확인하여 유저에게 전달한다
            var emailRule = /^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i;
            var inputEmail = document.querySelector('#email');
            inputEmail.addEventListener("keyup", checkEmail);

            function checkEmail() {
                var email = inputEmail.value;
                var checkRule = emailRule.test(email)
                
                if (checkRule==true) {
                    document.querySelector('.email-rule').style.visibility = "hidden";
                    return true;
                } else {
                    document.querySelector('.email-rule').style.visibility = "visible";
                    return false;
                }
            }
            
            // 비빌번호, 재입력 비밀번호가 일치하지 않을때 유저에게 메세지 전달
            // '비밀번호가 일치하지 않습니다'
            const inputPassword = document.querySelector('#password');
            const inputConfirmPassword = document.querySelector('#confirm-password');
            inputPassword.addEventListener("keyup", comparePassword);
            inputConfirmPassword.addEventListener("keyup", comparePassword);
            
            function comparePassword() {
                var confirmPassword = inputConfirmPassword.value;
                var password = inputPassword.value;

                if (confirmPassword === password) {
                    document.querySelector('.confirm-password').style.visibility = "hidden";
                    return true;
                } else {
                    document.querySelector('.confirm-password').style.visibility = "visible";
                    return false;
                }
            }

            // 회원가입 버튼 클릭시 아무런 변화가 생기지 않도록 기본 속성을 (type=button)으로 지정하였음
            // 유저가 올바른 양식으로 입력했을때만, 버튼의 속성이 (type=submit) 되도록 하여, 데이터를 전달할 수 있도록 한다
            const submitButton = document.querySelector('#submit');
            submitButton.addEventListener("click", checkInput);
            function checkInput() {
                const statusEmail = checkEmail();
                const statusPassword = comparePassword();
                const passwordLength = document.querySelector('#password').value.length;
                
                if (statusEmail==true && statusPassword==true && passwordLenth >=8) {
                    submitButton.type = "submit";   
                }
            }
        </script>

    </div>

</body>

</html>