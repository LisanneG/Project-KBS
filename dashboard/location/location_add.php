<?php
session_start();
include '../include/framework.php';
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
	<?php include '../include/css.php'; ?>
</head>
<body>
    <?php include '../include/navbar.php'; ?>

    <section id="dashboard-content" class="container-fluid">
    <h1> Locaties </h1>   
    		<nav class="nav nav-tabs" id="myTab" role="tablist">
			<a class="nav-item nav-link active" id="nav-toevoegen-tab" data-toggle="tab" href="#nav-toevoegen" role="tab" aria-controls="nav-toevoegen" aria-selected="true">Toevoegen</a>
			<a class="nav-item nav-link" id="nav-wijzigen-tab" data-toggle="tab" href="#nav-wijzigen" role="tab" aria-controls="nav-wijzigen" aria-selected="false">Wijzigen</a>
		</nav>
 	<h1>Locatie toevoegen</h1>
        <form class="form-horizontal" action="location_add.php" method="post">
	        
		<div class="form-group">
                    <div class="col">
                            <input type="text" class="form-control" placeholder="Plaats" name="name">
                    </div>
		</div>	
            <div class="form-group">
		<div class="row">
			<div class="col">
				<input type="text" class="form-control" placeholder="Adres" name="address">
			</div>
			<div class="col">
				<input type="text" class="form-control" placeholder="Postcode" name="postal_code">
			</div>
		</div>
            </div>
		<div class="form-group">
                    <div class="col">
                            <input type="text" class="form-control" placeholder="Hoofdnummer" name="main_number">
                    </div>
		</div>	            
		<div class="form-group">
                    <div class="col">
                            <input type="text" class="form-control" placeholder="Intern-nummer" name="inntern_number">
                    </div>
		</div>	    
		<div class="form-group">
			<div class="col">
                            <input type="submit" class="btn btn-primary" name="submit" value="Toevoegen">
			</div>
		</div>
	</form> 

    
 <?php 

if (isset($_POST["submit"])){
	$sql = "INSERT INTO location (name, address, postal_code, main_number, intern_number) VALUES (?,?,?,?,?)";
	$stmt = GetDatabaseConnection()->prepare($sql);
	$stmt->execute(array($_POST["Plaats"], $_POST["Adres"], $_POST["Postcode"], $_POST["Hoofdnummer"], $_POST["Internnummer"]));
 
}

?>   
    
    
    
    	<?php include '../include/footer.php'; ?>
</body>
</html>