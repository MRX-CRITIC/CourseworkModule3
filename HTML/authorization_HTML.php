<link rel="stylesheet" href="../Style/StyleAuthorization.css">
<div class="center">

    <h1>Авторизация</h1>

    <form action="../PHP/authorization.php" method="post">

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

        <div class="pass">Забыли пароль?</div>
        <input type="submit">
    </form>
    <div class="signup_link">Вы новый пользователь? <a href="../HTML/registration_HTML.php">Регистрация</a>
    </div>

<?php
session_start();
if (!empty($_SESSION['user'])) {
    header("location: ../HTML/main.php");
}
?>