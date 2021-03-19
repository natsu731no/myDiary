<?php
include_once "../classes/user.php";
include_once "../classes/time.php";
include_once "../classes/checkPage.php";

if(isset($_GET['id'])) { 
    $no = $_GET['id']; 
}
$diary_no = $no;

$time = new Time;
$date = $time->getTime();

$check = new checkPage;
$checkPage = $check->check($diary_no);
$title = $checkPage['title'];
$category = $checkPage['category_name'];
$diary_text = $checkPage['diary_text'];

$user = new User;
$user->updateDiary($diary_no, $date, $title, $category, $diary_text);
