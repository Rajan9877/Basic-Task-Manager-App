<?php
session_start();
session_unset();
session_destroy();
setcookie('remember_token', $_COOKIE['remember_token'], time()-(86400*30),"/");
setcookie('name', $_SESSION['name'], time()-(86400*30),"/");
header("Location: login.php");
?>