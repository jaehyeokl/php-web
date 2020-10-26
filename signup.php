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
        <form class="form">
            <span class="form__text">id</span>
            <input type="email" maxlength="50"class="form__input">
            <span class="form__text">name</span>
            <input type="text" maxlength="12" class="form__input">
            <span class="form__text">password</span>
            <input type="password" maxlength="10" class="form__input">
            <span class="form__text">confirm password</span>
            <input type="password" maxlength="10" class="form__input">
            <!-- span 공간을 차지하기 위해 visibility: hiddine -->
            <span class="form__text confirm-password">비밀번호가 일치하지 않습니다</span>
            <button class="form__button">Sign In</button>
        </form>
    </div>

</body>

</html>