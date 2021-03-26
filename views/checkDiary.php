<?php
session_start();
include_once "../classes/checkPage.php";
include_once "../classes/category.php";
include_once "../classes/database.php";
include_once "../classes/user.php";
include_once "../classes/time.php";

if(isset($_GET['id'])) { 
    $diary_no = $_GET['id']; 
}

$check = new checkPage;
$checkPage = $check->check($diary_no);

$date = new Time;
$getDate = $date->getDateDay();

//カテゴリー取得
$category = new Category;
$cat_result = $category->getCat($_SESSION['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css4.6/bootstrap.css">
    <script src="https://kit.fontawesome.com/f3d03e8132.js" crossorigin="anonymous"></script>

    <title>CHECK DIARY</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-info">
        <a href="mainPage.php?id=<?= $_SESSION['user_id'] ?>" class="navbar-brand">
            <h1 class="h3" >My Diary</h1>
        </a>
        <div class="ml-auto">
            <ul class="navbar-nav">
                <a class="btn btn-warning" href="../views/makeDiary.php?id=<?= $_SESSION['user_id'] ?>"><i class="far fa-plus-square"></i> &thinsp; CREATE DIARY</a>
                <li class="nav-item"><a class="nav-link text-dark">Username: <?= $_SESSION['username'] ?></a></li>
                <li class="nav-item"><a href="../actions/logout.php" class="nav-link text-danger">Log out &thinsp; <i class="fas fa-sign-out-alt"></i></a></li>
            </ul>
        </div>
    </nav>

    <main class="container" style="padding-top:80px">
    <form action="../actions/editDiary.php" method="POST">
    <input type="hidden" name="diary_no" value="<?= $diary_no ?>">
        <div class="row">
            <div class="py-3">
                <a name="date">DATE : <?= $getDate ?></a>
                 <!-- <h6 name="date">DATE : <?= $checkPage['date'] ?></h6> -->
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <div class="col-7">
                                <h6 for="title">TITLE</h6>
                                <input type="text" name="title" id="title" class="form-control mb-2" value="<?= $checkPage['title'] ?>" required autofocus>
                            </div>

                            <div class="col-4">
                                <h6 for="category">CATEGORY</h6>
                                <?php
                                    if($cat_result->num_rows == 0){
                                ?>
                                <input type="text" name="category" id="category" list="cate_list" class="form-control mb-2" value="<?= $checkPage['category_name'] ?>" required >
                                <?php 
                                    }else{
                                ?>
                                
                                <input name="category" id="category" list="cate_list" class="form-control mb-2" value="<?= $checkPage['category_name'] ?>" required>
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
                            <textarea class="form-control" name="diary_text" id="diary_text" rows="6"><?= $checkPage['diary_text'] ?></textarea>
                        
                        </div>
                        
                        <div class="button-group">
                            <input type="button" neme="btn_cancel" value="RETURN" onclick="history.back()" tabindex="3" class="w-20 btn btn-secondary btn-lg float-left"></input>
                            
                            <a name="btn_delete" class="w-25 btn btn-outline-danger btn-lg float-right" tabindex="2" href="../actions/deleteDiary.php?id=<?= $diary_no ?>"><i class="fas fa-trash-alt"></i>&thinsp; DELETE</a>
                            <button type="submit" name="btn_edit" class="w-25 btn btn-warning btn-lg float-right mr-3" tabindex="1" ><i class="fas fa-pen-nib"></i>&thinsp; UPDATE</button>
                        
                        </div>
                    </div>    
                        
                </div>
            </div>
        </div>
    </form>

    
</body>
<script src="../script/bootstrap.bundle.js"></script>
</html>