<?php
	session_start();
	unset($_SESSION["user"]);
	unset($_POST["user"]);
	unset($_POST["password"]);
	session_destroy();
	header("location: login.php");
	exit();
?>