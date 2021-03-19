<?php
session_start();
include "../classes/user.php";
include "../classes/category.php";


if(isset($_GET['id'])) { 
    $user_id = $_GET['id']; 
}


$user = new User;
$diary_list = $user->indicateList($user_id);



$cate = new Category;
$category_list = $cate->getCateList($user_id);
$date_list = $cate->getDateList($user_id);
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
    <!--menu ber-->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="mainPage.php?id=<?= $_SESSION['user_id'] ?>" class="navbar-brand">
            <h1 class="h3">My Diary</h1>
        </a>
        <div class="ml-auto">
            <ul class="navbar-nav">
                <a class="btn btn-outline-warning" href="../views/makeDiary.php?id=<?= $_SESSION['user_id'] ?>">CREATE DIARY</a>
                <li class="nav-item"><a href="#" class="nav-link">Username: <?= $_SESSION['username'] ?></a></li>
                <li class="nav-item"><a href="../actions/logout.php" class="nav-link text-danger">Log out</a></li>
            </ul>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-10"><!-- call to database -->
                <table class="table table-hover">
                    
                    <div class="row card-group">
                    <?php
                    while($user = $diary_list->fetch_assoc()){
                    ?>
                        <div class="col-sm-3">
                        
                        <div class="card">
                          <div class="card-header"><?= $user['date']?></div>
                            <div class="card-body">
                              <h5 class="card-title"><?= $user['title']?></h5>
                              <p class="card-text">Category : <?= $user['category_name']?></p>
                              <a href="../views/checkDiary.php?id=<?= $user['diary_no'] ?>" class="btn btn-outline-info">Look</a>
                            </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                    
                </table>
            </div> 
            <div class="col-md-2">
                <div class="categories">Categories
                    <ul class="list-group d-flex">
                        <?php
                        while($categories = $category_list->fetch_assoc()){

                            $cate_count = $cate->countCategory($categories['category_id']);

                            if($cate_count > 0){
                                // $cate_count = $cate->countCategory($categories['category_id']);
                                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                                     . $categories['category_name'].
                                      "<span class='badge bg-primary text-light rounded-pill'>"
                                     . $cate_count . "</span></li>";
                            }
                        }
                        ?>

                        <div class="date">Date
                            <ul class="list-group d-flex">
                            <?php
                                while($date = $date_list->fetch_assoc()){

                                    $date_count = $cate->countDate($date['date'], $user_id);

                                    if($date_count > 0){
                                        // $cate_count = $cate->countCategory($categories['category_id']);
                                        echo "<li class='list-group-item d-flex justify-content-between align-items-center'>"
                                             . $date['date'].
                                              "<span class='badge bg-primary text-light rounded-pill'>"
                                             . $date_count . "</span></li>";
                                    }
                                }
                            ?>                 
                            </ul>
                        </div>                        
                    </ul>
                </div>
            </div>
        </div>  
    </div>
</body>
<script src="../script/bootstrap.bundle.js"></script>
</html>