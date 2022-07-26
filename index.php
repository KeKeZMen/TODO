<?php require_once('vendor/db.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>To Do</title>
</head>

<body>

    <div class="wrapper">

        <div class="window">
            <h1>To Do</h1>

            <div class="task-info">
                <div class="created">
                    <h3 class="created-counter">
                        <?php
                            $createdCounter = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) FROM tasks"));
                            echo $createdCounter['COUNT(*)'];
                        ?>
                    </h3>
                    <p>Created tasks</p>
                </div>

                <div class="completed">
                    <h3 class="completed-counter">
                        <?php
                            $successCounter = mysqli_fetch_assoc(mysqli_query($connect, "SELECT COUNT(*) FROM tasks WHERE task_status = 1"));
                            echo $successCounter['COUNT(*)'];
                        ?>
                    </h3>
                    <p>Completed tasks</p>
                </div>
            </div>

            <div class="tasks">
                <?php 
                    $result = mysqli_query($connect, "SELECT * FROM tasks");
                    while ($row = mysqli_fetch_assoc($result)) {
                        $taskStatus = $row['task_status'] ? 'btn-success' : 'btn-unsuccess';
                        $taskStatus == 'btn-success' ? $pStatus = 'done' : $pStatus = null ;
                        echo '<div class="task"><button data-id="' . $row['id'] . '" class="btnTaskStatus ' . $taskStatus . '"></button><p class="' . $pStatus . '">' . $row['task_text'] . '</p><button data-id="' . $row['id'] . '" class="btn-delete"></button></div>';
                    };
                ?>
            </div>

            <form class="task-add">
                <input class="task-input" type="text" placeholder="Task name...">
                <button type="submit" class="btn-add"></button>
            </form>
        </div>

    </div>
       
<script src="scripts/jquery.min.js"></script>    
<script src="scripts/sweetalert.min.js"></script> 
<script src="scripts/script.js"></script>   
</body>

</html>