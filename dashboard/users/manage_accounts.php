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
	<title>Dashboard | beheren accounts</title>
	<?php include '../include/css.php'; ?>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">	
</head>
<body>
<?php include '../include/navbar.php'; ?>
	
	<h1>Medewerkers</h1>
	<?php 
		$stringBuilder = "SELECT * FROM user";
		$query = GetDatabaseConnection()->prepare($stringBuilder);
		$query->execute();
		?>

	<table class= "table table-bordered table-hover table-striped">
	<?php
	
	echo "<tr><th>User id</th><th>first name</th><th>tussenvoegsel</th><th>achternaam</th><th>geboortedatum</th><th>email</th><th>wachtwoord</th><th>admin</th><th>locatie id</th><th>Update</th><th>Delete</th></tr>";
	while($row = $query->fetch()){
		echo("<tr>");
		echo("
		<td>".$row['user_id'] ."</td>
		<td>".$row['first_name'] ."</td>
		<td>".$row['insertion'] ."</td>
		<td>".$row['last_name'] ."</td>
		<td>".$row['birthday'] ."</td>
		<td>".$row['email'] ."</td>
		<td>".$row['password'] ."</td>
		<td>".$row['admin'] ."</td>
		<td>".$row['location'] ."</td>
		<td><a href='#'>update</a></td>
		<td><a href='#'>delete</a></td>
		");
		echo("</tr>");
	}
	echo"</table>";
	?>
	        <a href="../users/add_user.php" class="btn btn-info btn-md">
          <span class="glyphicon glyphicon-plus"></span> Account toevoegen 
        </a>
	

<?php include '../include/footer.php'; ?>
</body>
	
</html>