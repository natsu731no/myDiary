<?php
session_start();
include "../classes/user.php";
include "../classes/category.php";
include "../classes/time.php";


if(isset($_GET['id'])) { 
    $user_id = $_GET['id']; 
}

//時間取得
$time = new Time;
$timetime = $time->getDateDay();

//カテゴリー取得
$category = new Category;
$cat_result = $category->getCat($user_id);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css4.6/bootstrap.css">
    <script src="https://kit.fontawesome.com/f3d03e8132.js" crossorigin="anonymous"></script>

    <title>My Diary</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-info">
        <a href="mainPage.php?id=<?= $_SESSION['user_id'] ?>" class="navbar-brand">
            <h1 class="h3">My Diary</h1>
        </a>
        <div class="ml-auto">
            <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link text-dark">Username: <?= $_SESSION['username'] ?></a></li>
                <li class="nav-item"><a href="../actions/logout.php" class="nav-link text-danger">Log out &thinsp; <i class="fas fa-sign-out-alt"></i></a></li>
            </ul>
        </div>
    </nav>
    
    <main class="container" style="padding-top:80px">
    <form action="../actions/makeDiary.php?id=<?= $_SESSION['user_id'] ?>" method="POST">
        <div class="row">
            <div class="py-3">
                <h6>TODAY : <?=$timetime; ?></h6>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <div class="col-7">
                                <h6 for="title">TITLE</h6>
                                <input type="text" name="title" id="title" class="form-control mb-2" required autofocus>
                            </div>

                            <div class="col-4">
                                <h6 for="category">CATEGORY</h6>
                                <?php
                                    if($cat_result->num_rows == 0){
                                ?>
                                <input type="text" name="category" id="category" list="cate_list" class="form-control mb-2"  required>
                                <?php 
                                    }else{
                                ?>
                                
                                <input name="category" id="category" list="cate_list" class="form-control mb-2"  required>
                                <datalist id="cate_list">
                                    <option value="" hidden>Select Category</option>
                                        <?php
                                        while($cat_row = $cat_result->fetch_assoc()){
                                            echo "<option value='".$cat_row['category_name']."'>";
                                        }
                                        ?>
                                </datalist>
                                </input>
                                
                                <?php } ?>
                            </div>
                            
                        </div>
                            
                        <div class="form-group">
                            <h6 for="username">TEXT</h6>
                            <textarea class="form-control" name="diary_text" id="diary_text" rows="6"></textarea>
                        
                        </div>

                        <div class="text-center">
                            <button type="submit" name="btn_save" value="submit" class="w-25 btn btn-success btn-lg"><i class="fas fa-file-download"></i> &thinsp; SAVE</button>
                            <!-- <a class="btn btn-outline-dark"href="../views/makeDiary.php">CANSEL</a> -->
                            <!-- <a class="btn btn-outline-warning" href="../views/makeDiary.php">CREATE DIARY</a> -->
                            <!-- <button type="button" name="btn_cansel" value="mainPage.php" class="w-25 btn btn-dark btn-lg">CANSEL</button> -->
                            <input type="button" neme="btn_cancel" value="CANCEL" onclick="history.back()" class="w-25 btn btn-dark btn-lg"></input>
                        </div>
                            
                    </div>    
                        
                </div>
            </div>
        </div>
    </form>           
    <script src="../script/bootstrap.bundle.js"></script>
</body>
</html>