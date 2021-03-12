<?php
session_start();
include "../classes/user.php";

if(isset($_GET['id'])) { 
    $user_id = $_GET['id']; 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css4.6/bootstrap.css">
    <title>My Diary</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="dashboard.php" class="navbar-brand">
            <h1 class="h3">My Diary</h1>
        </a>
        <div class="ml-auto">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="#" class="nav-link">Username: <?= $_SESSION['username'] ?></a></li>
                <li class="nav-item"><a href="../actions/logout.php" class="nav-link text-danger">Log out</a></li>
            </ul>
        </div>
    </nav>
    
    <main class="container" style="padding-top:80px">
        <div class="row">
            <div class="py-3">
            <!-- connect time.php -->
            <?php
                include_once "../classes/time.php";

                $timeget = new Time;
                $timetime = $timeget->getTime();
            ?>
            <h6>TODAY : <?= $timetime ?></h6>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="../actions/makeDiary.php?id=<?= $_SESSION['user_id'] ?>" method="POST">
                        <div class="form-group row">
                            <div class="col-7">
                                <label for="title">TITLE</label>
                                <input type="text" name="title" id="title" class="form-control mb-2" required autofocus>
                            </div>
                            <div class="col-4">
                                <label for="category">CATEGORY</label>
                                <select class="form-control">
                                    <option>
                                        <?php
                                            $sql_array = "SELECT * FROM categories";
                                            $array = $this->conn->query($sql_array);

                                            // foreach($array as ){

                                            // }
                                            
                                        ?>

                                    </option>
                                </select>
                            </div>
                        </div>
                            
                        <div class="form-group">
                            <label for="username">TEXT</label>
                            <textarea class="form-control" name="diary_text" id="diary_text" rows="6"></textarea>
                        
                        </div>

                        <div class="text-center">
                            <button type="submit" name="btn_save" value="submit" class="w-25 btn btn-success btn-lg">SAVE</button>
                            <!-- <a class="btn btn-outline-dark"href="../views/makeDiary.php">CANSEL</a> -->
                            <!-- <a class="btn btn-outline-warning" href="../views/makeDiary.php">CREATE DIARY</a> -->
                            <!-- <button type="button" name="btn_cansel" value="mainPage.php" class="w-25 btn btn-dark btn-lg">CANSEL</button> -->
                            <input type="button" neme="btn_cancel" value="CANCEL" onclick="history.back()" class="w-25 btn btn-dark btn-lg"></input>
                        </div>
                            
                        
                        </form>
                    </div>
                </div>
            </div>
                    
    <script src="../script/bootstrap.bundle.js"></script>
</body>
</html>