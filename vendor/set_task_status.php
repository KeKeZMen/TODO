<?php
    require_once('db.php');
    $id = $_POST['text'];
 
    mysqli_query($connect, "UPDATE tasks SET task_status = !task_status WHERE id = $id ");