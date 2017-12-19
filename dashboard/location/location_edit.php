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
	<title>Beheer | Locaties</title>
	<?php include 'include/css.php'; ?>
</head>
<body>
    <?php include 'include/navbar.php'; ?>
  
    <section id="dashboard-content" class="container-fluid">
    <h1> Locaties </h1>   
    		<nav class="nav nav-tabs" id="rightsTab" role="tablist">
			<a class="nav-item nav-link" id="nav-toevoegen-tab" data-toggle="tab" href="#nav-toevoegen" role="tab" aria-controls="nav-toevoegen" aria-selected="false">Toevoegen</a>
			<a class="nav-item nav-link active" id="nav-wijzigen-tab" data-toggle="tab" href="#nav-wijzigen" role="tab" aria-controls="nav-wijzigen" aria-selected="true">Wijzigen</a>
		</nav>
 	<h1>Locatie wijzigen</h1>    
    
    
    
    
    
    
    
    	<?php include 'include/footer.php'; ?>
</body>
</html>