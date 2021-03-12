<?php
session_start();
include "../classes/user.php";

if(isset($_GET['id'])) { 
    $user_id = $_GET['id']; 
}

$user = new User;
$diary_list = $user->indicateList($user_id);
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
        <a href="dashboard.php" class="navbar-brand">
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
            <div class="col-md-8"><!-- call to database -->
                <table class="table table-hover">
                    <thead class="tead-light">
                        <tr>
                            <th>DATE</th>
                            <th>TITLE</th>
                            <th>CATEGORY</th>
                            <th></th> <!--for the action -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    //$user->fech_assoc() - transform the result set/$user_list to an associative array
                    //user is an associative array
                    while($user = $diary_list->fetch_assoc()){
                    ?>
                        <tr>
                            <td><?= $user['date']?></td>
                            <td><?= $user['title']?></td>
                            <td><?= $user['category_name']?></td>
                            <td>
                                <!-- <a href="editUser.php?user_id=<?= $user['user_id'] ?>" class="btn btn-outline-warning btn-sm">Edit</a>
                                <a href="../actions/removeUser.php?user_id=<?= $user['user_id'] ?>" class="btn btn-outline-danger btn-sm">Remove</a> -->
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div> 
            <div class="col-md-3">
                 <div class="categories">Categories
                    <ul class="list-group d-flex">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                         
                          <span class="badge bg-primary rounded-pill">1</span>
                        </li> 

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            categoryB
                          <span class="badge bg-primary rounded-pill">12</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            categoryC
                          <span class="badge bg-primary rounded-pill">5</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            categoryD
                          <span class="badge bg-primary rounded-pill">3</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            categoryE
                          <span class="badge bg-primary rounded-pill">2</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            categoryF
                          <span class="badge bg-primary rounded-pill">10</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            categoryG
                          <span class="badge bg-primary rounded-pill">18</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
            
    </div>

    

    



    
</body>
<script src="../script/bootstrap.bundle.js"></script>
</html>