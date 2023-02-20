<?php
session_start();
if (empty($_SESSION['user'])) {
    header("location: /");
}
?>

<!doctype html>

<meta charset="UTF-8">
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="../Style/StyleTopPanel.css">
<title>Document</title>

<body>

<section class="link">

    <nav class="link-effect" id="link-effect">
        <a href="../HTML/main.php">Главная</a>
        <a href="../HTML/status-books.php">Статус</a>
        <a href="../HTML/adding-book.php">Добавить книгу</a>
        <a href="../HTML/search.php">Поиск</a>
        <a href="../PHP/exit.php">Выход</a>
    </nav>

    <div class="name-user">

        <span class="name-user-text">Пользователь: </span>
        <?php
        session_start();
        echo $_SESSION['user']['name'];
        ?>
        <div><a class="change" href="../HTML/rename.php"> (Редактировать / Изменить)</a></div>

    </div>
</section>
</body>
