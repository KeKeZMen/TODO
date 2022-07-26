<?php
    require_once('db.php');
    $id = mysqli_real_escape_string($connect, $_POST['text']);

    mysqli_query($connect, "DELETE FROM tasks WHERE id = $id");