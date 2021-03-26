<?php
session_start();
include_once "../classes/diary.php";
include_once "../classes/checkPage.php";

$diary_no = $_POST['diary_no'];
$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$category = $_POST['category'];
$diary_text = $_POST['diary_text'];

$diary = new Diary;
$diary->updateDiary($diary_no, $user_id, $title, $category, $diary_text);


