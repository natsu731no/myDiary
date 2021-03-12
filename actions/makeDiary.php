<?php
include_once "../classes/user.php";
include_once "../classes/time.php";

if(isset($_GET['id'])) { 
    $id = $_GET['id']; 
}

$time = new Time;
$date = $time->getTime();
$user_id = $id;

$title = $_POST['title'];
$diary_text = $_POST['diary_text'];
$category = $_POST['category'];


$user = new User;
$user->makeDiary($user_id, $date, $title, $diary_text, $category);