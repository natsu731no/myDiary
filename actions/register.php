<?php
require_once "../classes/user.php";

$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$origin = $_POST['btn_register']; //$_POST['btn_register'] can be eigther register or dashboard
//btn_register is the name of the button
//$origin = "register" or $origin = "dashboard"

$user = new User;
$user->createUser($username, $password, $origin);