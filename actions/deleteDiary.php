<?php
include_once "../classes/diary.php";
include_once "../classes/time.php";
include_once "../classes/checkPage.php";

if(isset($_GET['id'])) { 
    $no = $_GET['id']; 
}
$diary_no = $no;

$diary = new Diary;
$diary->deleteDiary($diary_no);