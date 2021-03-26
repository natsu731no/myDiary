<?php

//セッションをスタート
session_start();

//全てのセッション変数を開放する
session_unset();

//セッションに登録されたデータを全て破棄する
session_destroy();
header("location: ../views/login.php");
exit;
