<?php
session_start();
include 'framework.php';

if(!isset($_SESSION["email"])){
	header("Location: login.php"); //Redirecting to login.php
	exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">	
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<a class="navbar-brand" href="#">Dotcasting</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	<ul class="navbar-nav mr-auto">
	      		<li class="nav-item active">
	        		<a class="nav-link" href="#">Home</a>
	      		</li>
		      	<li class="nav-item">
		        	<a class="nav-link" href="#">Nieuwsbericht</a>
		      	</li>
		      	<form class="form-inline">
				    <div class="input-group">
				      <span class="input-group-addon" id="basic-addon1">ICON</span>
				      <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
				    </div>
				  </form>	      		      	
	    	</ul>	    
	    	<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="#">Welkom: <?php echo $_SESSION["email"]; ?></a></li>
				<li class="nav-item">
			    	<a class="nav-link" href="#">ICON</a>
			  	</li>
			  	<li class="nav-item">
			    	<button type="button" class="btn">Uitloggen</button>
			  	</li>
			</ul>	
	  	</div>
	</nav>

	<img src="../img/dotsolutions-logo.png" alt="dotsolutions logo" class="img-fluid">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>