<?php session_start();
	session_destroy();
	setcookie("user_login", "", time() - (86400 * 30), "/");
	header('refresh:2;url=login.php');

 ?>

 <p>Please Wait....</p>