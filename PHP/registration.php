<?php
require_once "../PHP/functions.php";

// Проверка на существование данных
if (
    !empty($_POST['login'])
    && !empty($_POST['password'])
    && !empty($_POST['password_repeat'])
    && !empty($_POST['name'])
) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    // Проверка повторения пароля
    if ($password != $_POST['password_repeat']) {
        echo "Пароль не совпадают!";
        exit();
    }

    // Хэшируем пароль
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Проверка существующего логина
    registration($login);

    // Запись в БД
    if (recordNewUser($login, $hash, $name)) {
        header("location: ../HTML/authorization_HTML.php");
    } else {
        echo "Ошибка 4000";
    };

} else {
    header("location: ../HTML/registration_HTML.php");
}





