<?php
    require_once('db.php');
    $text = mysqli_real_escape_string($connect, $_POST['text']);

    mysqli_query($connect, "INSERT INTO tasks (task_text, task_status) VALUES ('$text', 0)");

    echo mysqli_insert_id($connect);