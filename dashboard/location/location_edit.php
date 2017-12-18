<?php
session_start();
include 'include/framework.php';
if(!isset($_SESSION["email"])){
	header("Location: login.php"); //Redirecting to login.php
	exit();
}
if (isset($_POST["logout"])) {
	session_destroy(); //Removing the login session
	header("Location: login.php"); //Redirecting to login.php
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<?php include 'include/css.php'; ?>
</head>
<body>
    <?php include 'include/navbar.php'; ?>
  
    
    
    
    
    
    
    
    
    	<?php include 'include/footer.php'; ?>
</body>
</html>