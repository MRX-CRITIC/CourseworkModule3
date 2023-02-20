<?php
require_once "../HTML/top_panel.php";
require_once "../PHP/functions.php";

$authors = authors();

if (!empty($_POST)) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $vendor_code = $_POST['vendor_code'];
    $author_id = $_POST['author'];

    if (!empty($_POST['addAuthor'])) {

        repeatAuthor($_POST['addAuthor']);

        if (repeatAuthor($_POST['addAuthor'])) {

            echo "Такой автор уже существует";
            exit();

        }
        $addAuthor = $_POST['addAuthor'];
        $author_id = addAuthor($addAuthor);
    }
    AddNote($title, $description, $vendor_code, $author_id);
}

session_start();
if (empty($_SESSION['user'])) {
    header("location: /");
}
?>

<link rel="stylesheet" href="../Style/StyleBook.css">

<body>
<div class="blocks">
    <form class="block-1" method="post">

        <div class="margin"><h1>Добавление книги в базу данных: </h1></div>

        <div class="margin">
        <span class="block-2">
            <label for="author">Выбрать автора</label>
            <select id="author" name="author" required>

                <?php foreach ($authors as $author): ?>

                    <option value="<?= $author['id'] ?>">
                        <?= $author['name'] ?>
                    </option>

                <?php endforeach; ?>

            </select>
        </span>

            <span class="block-2">
            <label for="addAuthor">Не нашли автора?</label>
            <input id="addAuthor" name="addAuthor" placeholder="Добавьте">
        </span>

            <div class="margin">
                <input id="title" name="title" placeholder="Название книги" required>
            </div>

            <div class="margin">
                <textarea id="description" name="description" placeholder="Описание" required></textarea>
            </div>

            <div class="margin">
                <input id="vendor_code" name="vendor_code" placeholder="Артикул" required>
            </div>

            <input class="custom-btn btn-16" type="submit" value="Добавить">
        </div>
    </form>
</div>
</body>
