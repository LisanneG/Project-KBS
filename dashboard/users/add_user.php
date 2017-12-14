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

<html>
<head>
	<meta charset="UTF-8">
	<title>Dashboard | Account toevoegen</title>
	<?php include '../include/css.php'; ?>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">	
</head>
<body>
<?php include '../include/navbar.php'; ?>
<div class="container">
	<h1>Account toevoegen</h1>
	<form class="form-horizontal" action="add_user.php" method="post">
		<div class="form-group">
		<div class="row">
			<div class="col">
				<input type="text" class="form-control" placeholder="Voornaam" name="Voornaam">
			</div>
			<div class="col">
				<input type="text" class="form-control" placeholder="Tussenvoegsel" name="Tussenvoegsel">
			</div>
			<div class="col">
				<input type="text" class="form-control" placeholder="Achternaam" name="Achternaam">
			</div>
		</div>
		</div>
		<div class="form-group">
			<div class="col">
				<input type="date" class="form-control" placeholder="Geboortedatum" name="Geboortedatum">
			</div>
		</div>
		<div class="form-group">
			<div class="col">
				<input type="text" class="form-control" placeholder="Email" name="Email">
			</div>
		</div>
		<div class="form-group">
			<div class="col">
				<input type="password" class="form-control" Placeholder="Wachtwoord" name="Wachtwoord">
			</div>
		</div>
		<div class="form-group">
				<lable class="control-label col-sm-2">Admin:</lable>
			<div class="col">
				<input type="checkbox" name="Admin">
			</div>
		</div>
		<div class="form-group">
			<div class="col">
				<Select class="custom-select" placeholder="Locatie" name="Locatie">
				<option selected>Kies locatie</option>
				<option value="1">Zwolle</option>
				<option value="2">Meppel</option>
				<option value="3">Groningen</option>
				</select>
		</div>
		</br>
		<div class="form-group">
			<div class="col">
				<button type="submit" class="btn btn-primary" name="submit">Toevoegen</button>
			</div>
		</div>
	</form>
</div>
<?php 
	try{
		// Setting up the info for the database
		$host = "localhost";
		$username = "root";
		$password = "";
		$db = "dotcasting";

		// Trying to get a connection
		$conn = new PDO("mysql:dbname=$db;host=$host", $username, $password);
	}
	catch(PDOException $ex){
		// If for some reason the connection can't be made, it will give an error and stop with everything else
		die("<div class='alert alert-danger' role='alert'><strong>Error:</strong> kan geen verbinding maken</div>");
	}

if (isset($_POST["submit"])){
	$sql = "INSERT INTO user(first_name, insertion, last_name, birthday, email, password, admin, location) VALUES (?,?,?,?,?,?,?,?)";
	$stmt = $conn->prepare($sql);
	$stmt->execute(array($_POST["Voornaam"], $_POST["Tussenvoegsel"], $_POST["Achternaam"], $_POST["Geboortedatum"], $_POST["Email"], $_POST["Wachtwoord"], $_POST["Admin"], $_POST["Locatie"]));
 
}

?>


	<?php include '../include/footer.php'; ?>
</body>
	
</html>