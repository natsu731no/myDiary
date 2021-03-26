<?php
session_start();
include "../classes/user.php";
include "../classes/category.php";


// if(isset($_GET['id'])) { 
//     $user_id = $_GET['id']; 
// }


$user = new User;
$diary_list = $user->indicateList($_SESSION['user_id']);



$cate = new Category;
$category_list = $cate->getCateList($_SESSION['user_id']);
$date_list = $cate->getDateList($_SESSION['user_id']);
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
    <!--menu ber-->
    <nav class="navbar navbar-expand-md navbar-dark bg-info">
        <a href="mainPage.php?id=<?= $_SESSION['user_id'] ?>" class="navbar-brand">
            <h1 class="h3">My Diary</h1>
        </a>
        <div class="ml-auto">
            <ul class="navbar-nav">
                <?php
                if($diary_list->num_rows){
                ?>
                <a class="btn btn-warning" href="../views/makeDiary.php?id=<?= $_SESSION['user_id'] ?>"><i class="far fa-plus-square"></i> &thinsp; CREATE DIARY</a>
                <?php
                }
                ?>
                <!-- <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Username: <?= $_SESSION['username'] ?>
                
                </button> -->
                <li class="nav-item"><a class="nav-link text-dark">Username: <?= $_SESSION['username'] ?></a></li>
                <li class="nav-item "><a href="../actions/logout.php" class="nav-link text-danger">Log out &thinsp; <i class="fas fa-sign-out-alt"></i></a></li>
            </ul>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-10"><!-- call to database -->
                <table class="table table-hover">
                    <?php
                    if($diary_list->num_rows){
                    ?>
                    <div class="row card-group">
                    <?php
                    while($user = $diary_list->fetch_assoc()){
                    ?>
                        <div class="col-sm-3">
                        
                        <div class="card">
                          <div class="card-header bg-dark text-light"><?= $user['date']?></div>
                            <div class="card-body">
                              <h5 class="card-title"><?= $user['title']?></h5>
                              <p class="card-text">Category : <?= $user['category_name']?></p>
                              <a href="../views/checkDiary.php?id=<?= $user['diary_no'] ?>" class="btn btn-outline-info btn-sm">Open</a>
                            </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                    }else{
                    ?>
                    <!-- <button type="button" class="btn btn-outline-warning btn-lg">Large button</button> -->
                    <div class="text-center">
                        <h3>Your diary will appear here.</h3>
                        <a class="btn btn-warning btn-lg w-50 h-100" href="../views/makeDiary.php?id=<?= $_SESSION['user_id'] ?>"><i class="far fa-plus-square"></i> &thinsp; CREATE DIARY</a>
                    </div>
                    
                    <?php
                    }
                    ?>
                    
                </table>
            </div>
            <?php
            if($diary_list->num_rows){
            ?> 
            <div class="col-md-2">
                <div class="categories text-muted"><i class="fas fa-layer-group"></i>&thinsp; Categories
                    <ul class="list-group d-flex text-muted">
                        <?php
                        while($categories = $category_list->fetch_assoc()){

                            $cate_count = $cate->countCategory($categories['category_id']);

                            if($cate_count > 0){
                                // $cate_count = $cate->countCategory($categories['category_id']);
                                echo "<li class='list-group-item d-flex justify-content-between align-items-center text-muted'>"
                                     . $categories['category_name'].
                                      "<span class='badge bg-dark text-light rounded-pill'>"
                                     . $cate_count . "</span></li>";
                            }
                        }
                        ?>
                        <br>

                        <div class="date"><i class="far fa-calendar-alt"></i>&thinsp;Date
                            <ul class="list-group d-flex">
                            <?php
                                while($date = $date_list->fetch_assoc()){

                                    $date_count = $cate->countDate($date['date'], $_SESSION['user_id']);

                                    if($date_count > 0){
                                        // $cate_count = $cate->countCategory($categories['category_id']);
                                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                                             . $date['date'].
                                              "<span class='badge bg-dark text-light rounded-pill'>"
                                             . $date_count . "</span></li>";
                                    }
                                }
                            ?>                 
                            </ul>
                        </div>                        
                    </ul>
                </div>
            </div>
            <?php
            }
            ?>
        </div>  
    </div>
</body>
<script src="../script/bootstrap.bundle.js"></script>
</html>