<?php

require_once "../PHP/function.php";
require_once "../HTML/top_panel.php";

$table = getTableStatus();

$N = 0;

session_start();

if (empty($_SESSION['user'])) {
    header("location: /");
}

?>

<link rel="stylesheet" href="../Style/StyleStatus.css">

<table class="table-base">

    <tr>
        <th>П/П</th>
        <th>Название книги</th>
        <th>Статус</th>
        <th>Дата</th>
    </tr>


    <?php foreach ($table as $tables): ?>

        <tr>
            <td><? echo $N = $N + 1; ?></td>
            <td class="name"><?= $tables['name'] ?></td>
            <td class="status"><?= $tables['status'] ?></td>
            <td><?= $tables['date'] ?></td>
        </tr>

    <?php endforeach; ?>

</table>
