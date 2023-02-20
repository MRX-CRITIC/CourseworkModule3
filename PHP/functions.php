<?php

const hostname = '127.0.0.1';
const username = 'root';
const password = '';
const database = 'library';

function db_connect()  // Подключение к БД + установка котировки
{
    $mysqli = @mysqli_connect(hostname, username, password, database);

    if (mysqli_connect_errno()) {
        printf(
            'Ошибка подключения к БД: %s',
            mysqli_connect_error()
        );
        die();
    }

    if (!mysqli_set_charset($mysqli, 'utf8')) {
        printf(
            'Ошибка установки кодировки к БД: %s',
            mysqli_error($mysqli)
        );
        die();
    }
    return $mysqli;
}

function db_close($mysqli)  // закрывает открытое соединение с БД
{
    return mysqli_close($mysqli);
}

function registration($login)  // регистрация пользователя, проверка на существование логина, применена в registration.php
{
    $mysqli = db_connect();
    $login = mysqli_real_escape_string($mysqli, $login);

    $sql = "select login from users where login = '{$login}'";

    $user = mysqli_query($mysqli, $sql);
    $user = mysqli_fetch_all($user, MYSQLI_ASSOC);

    db_close($mysqli);

    if (count($user) > 0) {
        echo "Такой пользователь уже существует!";
        exit();
    }
    return $user;
}

function recordNewUser($login, $password, $name)  // запись нового пользователя в БД, применена в registration.php
{
    $mysqli = db_connect();

    $login = mysqli_real_escape_string($mysqli, $login);
    $password = mysqli_real_escape_string($mysqli, $password);
    $name = mysqli_real_escape_string($mysqli, $name);

    $sql = "insert into users
    (login, password, name) values
                               ('{$login}', '{$password}', '{$name}');";

    $BD = mysqli_query($mysqli, $sql);

    db_close($mysqli);
    return $BD;
}

function authorization($login, $password) // авторизация пользователя применена в authorization.php
{
    $mysqli = db_connect();

    $login = mysqli_real_escape_string($mysqli, $login);
    $password = mysqli_real_escape_string($mysqli, $password);

    $sql = "select id, name, login, password from users where login = '{$login}';";

    $BD = mysqli_query($mysqli, $sql);

    $user = mysqli_fetch_all($BD, MYSQLI_ASSOC);

    if (!empty($user)) {

        if (password_verify($password, $user[0]["password"])) {
            session_start();
            $_SESSION['user']['login'] = $user[0]["login"];
            $_SESSION['user']['id'] = $user[0]["id"];
            $_SESSION['user']['name'] = $user[0]['name'];
            header("location: ../HTML/main.php");
        } else {
            echo "Логин или пароль введен не верно!";
        }
    } else {
        echo "Логин или пароль введен не верно!";
    }
    db_close($mysqli);
    return $BD;
}

function getTable()  // вывод общей таблицы из БД books файл main.php
{
    $mysqli = db_connect();

    $sql = "select books.id, books.name as title, books.description, books.vendor_code, books.date, a.name as author from books
                                                        LEFT JOIN authors a on a.id = books.author_id ORDER BY title;";

    $tables = mysqli_query($mysqli, $sql);
    $tables = mysqli_fetch_all($tables, MYSQLI_ASSOC);

    db_close($mysqli);
    return $tables;
}

function AddNote($title, $description, $vendor_code, $author_id)  // добавление новой книги в БД + их статуса, применяется в adding-book.php
{
    $mysqli = db_connect();

    $title = mysqli_real_escape_string($mysqli, $title);
    $description = mysqli_real_escape_string($mysqli, $description);
    $vendor_code = mysqli_real_escape_string($mysqli, $vendor_code);
    $author_id = mysqli_real_escape_string($mysqli, $author_id);

    $sql = "INSERT INTO books (name, description, vendor_code, date, author_id)
                VALUES ('{$title}', '{$description}', '{$vendor_code}', now(), '{$author_id}');";

    $sql_2 = "INSERT INTO book_status (book_id, status, date)
                VALUES (LAST_INSERT_ID(), 'Готов к выдаче', now());";

    $BD = mysqli_query($mysqli, $sql);

    if ($BD) {
        $BD = mysqli_query($mysqli, $sql_2);
    }
    db_close($mysqli);
    return $BD;
}

function authors()   // выводит всех существующих авторов при добавление книги, применяется в adding-book.php
{
    $mysqli = db_connect();

    $sql = "select * from authors ORDER BY name";

    $author = mysqli_query($mysqli, $sql);
    $author = mysqli_fetch_all($author, MYSQLI_ASSOC);

    db_close($mysqli);
    return $author;
}

function addAuthor($addAuthor) // добавление новога автора, в случае если такого автора нет в БД, применяется в adding-book.php
{
    $mysqli = db_connect();

    $sql = "insert into authors
        (name) values
                      ('{$addAuthor}');";

    mysqli_query($mysqli, $sql);
    $addAuthor = mysqli_insert_id($mysqli);

    db_close($mysqli);
    return $addAuthor;
}

function getTableStatus() // выводит таблицу статусов книг, применяется в status-books.php
{
    $mysqli = db_connect();


    $sql = "select b.name, status, book_status.date from book_status
        left join books b on b.id = book_status.book_id ORDER BY name;";

    $tables_status = mysqli_query($mysqli, $sql);
    $tables_status = mysqli_fetch_all($tables_status, MYSQLI_ASSOC);

    db_close($mysqli);
    return $tables_status;
}

function repeatAuthor($repeatAuthor) // проверка на существование автора который добавляется вновь, применяется в adding-book.php
{
    $mysqli = db_connect();

    $repeatAuthor = mysqli_real_escape_string($mysqli, $repeatAuthor);

    $sql = "select name from authors WHERE name = '{$repeatAuthor}'";

    $authorR = mysqli_query($mysqli, $sql);
    $authorR = mysqli_fetch_all($authorR, MYSQLI_ASSOC);

    db_close($mysqli);
    return $authorR;
}

function stateChange($new_status, $book_id) // изменение текущего статуса книги, применяется в main.php
{
    $mysqli = db_connect();

    $new_status = mysqli_real_escape_string($mysqli, $new_status);

    $sql = "UPDATE book_status SET status = '{$new_status}', date = NOW() WHERE book_id = '{$book_id}';";

    $new_status = mysqli_query($mysqli, $sql);

    db_close($mysqli);
    return $new_status;
}

//function ReName($new_name, $user_id) //  изменение логина, применяется в rename.php
//{
//    $mysqli = db_connect();
//
//    $new_name = mysqli_real_escape_string($mysqli, $new_name);
//
//    $sql = "UPDATE users SET name = '{$new_name}' WHERE id = '{$user_id}';";
//
//    mysqli_query($mysqli, $sql);
//
//    db_close($mysqli);
//}