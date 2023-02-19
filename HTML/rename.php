<?php

require_once "../HTML/top_panel.php";
require_once "../PHP/function.php";


if (!empty($_POST)) {

    $new_name = $_POST['new_name'];
    $user_id = $_SESSION['user']['id'];
    var_dump($new_name, $user_id);

    ReName($new_name, $user_id);

}



session_start();

if (empty($_SESSION['user'])) {
    header("location: /");
}

?>

<link rel="stylesheet" href="../Style/StyleRename.css">

<form method="post">

    <input type="text" name="new_name" id="new_name" required>
    <input type="submit" name="user_id" id="user_id">

</form>
