<?php
session_start();
include_once "../classes/checkPage.php";
include_once "../classes/category.php";
include_once "../classes/database.php";
include_once "../classes/user.php";

if(isset($_GET['id'])) { 
    $diary_no = $_GET['id']; 
}

class Id extends database{
    public function getId($diary_no){
        $sql = "SELECT `user_id` FROM diary WHERE diary_no = '$diary_no'";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();;

        }else{
            die("Error selecting users" . $this->conn->error);
        }
    }
}

$id = new Id;
$getId = $id->getId($diary_no); 

$check = new checkPage;
$checkPage = $check->check($diary_no);

//カテゴリー取得
$category = new Category;
$cat_result = $category->getCat($getId['user_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css4.6/bootstrap.css">
    <title>CHECK DIARY</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="mainPage.php?id=<?= $_SESSION['user_id'] ?>" class="navbar-brand">
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
    <form action="../actions/makeDiary.php?id=<?= $_SESSION['user_id'] ?>" method="POST">
        <div class="row">
            <div class="py-3">
                <a name="date">DATE : <?= $checkPage['date']?></a>
                 <!-- <h6 name="date">DATE : <?= $checkPage['date'] ?></h6> -->
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        
                        <div class="form-group row">
                            <div class="col-7">
                                <label for="title">TITLE</label>
                                <input type="text" name="title" id="title" class="form-control mb-2" value="<?= $checkPage['title'] ?>" required >
                            </div>

                            <div class="col-4">
                                <label for="category">CATEGORY</label>
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
                            <label for="username">TEXT</label>
                            <textarea class="form-control" name="diary_text" id="diary_text" rows="6"><?= $checkPage['diary_text'] ?></textarea>
                        
                        </div>
                        
                        <div class="button-group">
                            <input type="button" neme="btn_cancel" value="RETURN" onclick="history.back()" class="w-20 btn btn-secondary btn-lg float-left"></input>
                            
                            <a name="btn_delete" class="w-25 btn btn-outline-danger btn-lg float-right" href="../views/makeDiary.php">DELETE</a>
                            <a name="btn_edit" class="w-25 btn btn-warning btn-lg float-right" href="../actions/editDiary.php?id=<?= $diary_no ?>">EDIT</a>
                        
                        </div>
                        

                        <!-- <div class="text-right">
                            

                            
                            
                            
                             <a class="btn btn-outline-dark"href="../views/makeDiary.php">CANSEL</a> -->
                            <!-- <a class="btn btn-outline-warning" href="../views/makeDiary.php">CREATE DIARY</a> -->
                            <!-- <button type="button" name="btn_cansel" value="mainPage.php" class="w-25 btn btn-dark btn-lg">CANSEL</button> -->
                            
                        <!-- </div> -->
                            
                    </div>    
                        
                </div>
            </div>
        </div>
    </form>

    
</body>
<script src="../script/bootstrap.bundle.js"></script>
</html>