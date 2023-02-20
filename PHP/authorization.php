<?php
require_once "../PHP/functions.php";

// Проверка на существование данных
if (
    !empty($_POST['login'])
    && !empty($_POST['password'])
) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    // Обращение к БД
    authorization($login, $password);
}

