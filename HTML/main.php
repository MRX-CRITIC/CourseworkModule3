<?php
require_once "../HTML/top_panel.php";
require_once "../PHP/functions.php";

$table = getTable();

$N = 0;

if (!empty($_POST)) {

    $new_status = $_POST['new_status'];
    $book_id = $_POST['id'];

    stateChange($new_status, $book_id);
}



session_start();
if (empty($_SESSION['user'])) {
    header("location: /");
}
?>

<link rel="stylesheet" href="../Style/StyleMain.css">

<table class="table-base">

    <tr class="th-1">
        <th class="p/p">П/П</th>
        <th>Название книги</th>
        <th>Описание</th>
        <th>Артикул</th>
        <th>Дата</th>
        <th>Автор</th>
        <th>Выдача / Возврат</th>
    </tr>

    <?php foreach ($table as $tables): ?>

        <tr>

            <td><? echo $N = $N + 1; ?></td>
            <td class="title"><?= $tables['title'] ?></td>
            <td class="description"><?= $tables['description'] ?></td>
            <td class="vendor_code"><?= $tables['vendor_code'] ?></td>
            <td class="date"><?= $tables['date'] ?></td>
            <td class="author"><?= $tables['author'] ?></td>
            <td>
                <form class="" method="post">

                    <input type="hidden" name="id" id="id" value="<?= $tables['id'] ?>">

                    <select class="new_status" id="new_status" name="new_status">

                        <option>
                            Готова к выдаче
                        </option>
                        <option>
                            Отсутствует
                        </option>
                    </select>

                    <input class="custom-btn btn-16" type="submit" value="Изменить">

                    <?= $tables['new_status'] ?>

                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

