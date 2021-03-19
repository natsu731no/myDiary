<?php
include_once "../classes/user.php";
include_once "../classes/time.php";
include_once "../classes/category.php";


if(isset($_GET['id'])) { 
    $id = $_GET['id']; 
}

// 時間取得
$time = new Time;
$date = $time->getTime();

$user_id = $id;
$title = $_POST['title'];
$diary_text = $_POST['diary_text'];
$category = $_POST['category'];

// 日記を作成
$user = new User;
$user->makeDiary($user_id, $date, $title, $diary_text, $category);


// カテゴリーを追加、表示
$category = new Category;
// $getCate = $category->getCate($user_id);
$inputCate= $category->inputCate($user_id, $category);


