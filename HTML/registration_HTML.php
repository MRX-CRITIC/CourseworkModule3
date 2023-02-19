<?php

session_start();

if (!empty($_SESSION['user'])) {
    header("location: ..\HTML\main.php");
}

?>

<link rel="stylesheet" href="../Style/StyleRegistration.css">
<div class="center">

    <h1>Регистрация</h1>

    <form action="../PHP/registration.php" method="post">

        <div class="txt_field">
            <input type="text" name="name" required>
            <label>Имя и Фамилия</label>
            <span></span>
        </div>

        <div class="txt_field">
            <input type="text" name="login" required>
            <label>Логин</label>
            <span></span>
        </div>

        <div class="txt_field">
            <input type="password" name="password" required>
            <label>Пароль</label>
            <span></span>
        </div>

        <div class="txt_field">
            <input type="password" name="password_repeat" required>
            <label>Повторите пароль</label>
            <span></span>
        </div>

<!--        <div>--><?php //echo $_SESSION['message']; unset($_SESSION['message']); ?><!--</div>-->

        <input type="submit">

    </form>

    <div class="signup_link">У Вас есть аккаунт? <a href="../HTML/authorization_HTML.php">Авторизация</a>
    </div>

