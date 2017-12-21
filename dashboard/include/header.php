<?php

session_start();

if(!isset($_SESSION["email"])){
	header("Location: /KBS/Project-KBS/dashboard/login.php"); //Redirecting to login.php
	exit();
}

if (isset($_POST["logout"])) {
	session_destroy(); //Removing the login session

	header("Location: /KBS/Project-KBS/dashboard/login.php"); //Redirecting to login.php
	exit();
}

?>