<?php
include '../include/framework.php';
include '../include/header.php';
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

	
	<?php 
		
	
	
	//het updaten van medewerkers:
	$sql = ("UPDATE user SET
		first_name=?, 
		insertion=?, 
		last_name=?, 
		birthday=?, 
		email=?, 
		password=?, 
		admin=?, 
		location=?
		WHERE user_id=?"
		);
	if(isset($_POST["Updaten"]))	{
		
		$required = array("voornaam","achternaam","email","wachtwoord","verjaardag", "locatie");
		foreach($required as $field) {
			if(empty($_POST[$field])){
				print("<div class=\"alert alert-danger\"role=\"alert\">Alle velden moeten ingevuld worden</div>");
				break;
	}		else{
	
		$user_id = $_POST["user_id"];
		$voornaam = $_POST["voornaam"];
		$tussenvoegsel = $_POST["tussenvoegsel"];
		$achternaam = $_POST["achternaam"];
		$verjaardag = $_POST["verjaardag"];
		$email = $_POST["email"];
		$wachtwoord = $_POST["wachtwoord"];
		$locatie = $_POST["locatie"];
			if (isset($_POST["admin"])){
		$admin = 1;
	} else {
		$admin = 0;
	}

		
		$stmt = GetDatabaseConnection()->prepare($sql);
		if ($stmt->execute(array($voornaam, $tussenvoegsel, $achternaam, $verjaardag, $email, $wachtwoord, $admin, $locatie, $user_id))){
			print("<div class=\"alert alert-success\"role=\"alert\">Medewerker succesvol bewerkt</div>");
			break;
		}
	}
	
	$user_id = "";
	$naam ="";
		}
	}
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
	
//het toevoegen van medewerkers

if (isset($_POST["submit"])){
	$required = array("Voornaam","Achternaam","Email","Wachtwoord","Geboortedatum", "Locatie");
	
	foreach($required as $field) {
	if(empty($_POST[$field])){
		print("<div class=\"alert alert-danger\"role=\"alert\">Alle velden moeten ingevuld worden</div>");
		break;
	}else{
	$voornaam = $_POST["Voornaam"];
	$tussenvoegsel = $_POST["Tussenvoegsel"];
	$achternaam = $_POST["Achternaam"];
	$geboortedatum = $_POST["Geboortedatum"];
	$email = $_POST["Email"];
	$wachtwoord = $_POST["Wachtwoord"];
	$hashed_password = hashPassword($wachtwoord);
	$locatie =  $_POST["Locatie"];
	
	if (isset($_POST["Admin"])){
		$admin = 1;
	} else {
		$admin = 0;
	}
	$sql = "INSERT INTO user(first_name, insertion, last_name, birthday, email, password, admin, location) VALUES (?,?,?,?,?,?,?,?)";
	$stmt = $conn->prepare($sql);
	if($stmt->execute(array($voornaam, $tussenvoegsel, $achternaam, $geboortedatum, $email, $hashed_password, $admin, $locatie))){
		print("<div class=\"alert alert-success\"role=\"alert\">Medewerker succesvol toegevoegd</div>");
		break;
	}
}
}
}
//het verwijderen van medewerkers
if(isset($_GET["user_id"]) && $_GET["user_id"] != ""  && $_GET["method"] == "delete"){
	print $_GET["user_id"];
	$nummer = $_GET["user_id"];
	
	if (isset($_GET["user_id"])) {
	$sql = "DELETE FROM user WHERE user_id =?";
	$stmt = GetDatabaseConnection()->prepare($sql);
	$stmt->execute(array($_GET["user_id"]));
	}
}
?>


	<h1>Medewerkers</h1>
	<?php 
		$stringBuilder = "SELECT * FROM user";
		$query = GetDatabaseConnection()->prepare($stringBuilder);
		$query->execute();
		?>
	<div class="container-fluid" style="border:1px solid #cecece;">
                <div class="row">
				<div class="table-responsive">
			<table class= "table table-bordered table-hover">

	<?php
	
	echo "<tr><th>User id</th><th>first name</th><th>tussenvoegsel</th><th>achternaam</th><th>geboortedatum</th><th>email</th><th>wachtwoord</th><th>admin</th><th>locatie id</th><th>Update</th><th>Delete</th></tr>";
	while($user = $query->fetch()){
		echo("<tr>");
			echo("
				<td>".$user['user_id'] ."</td>
				<td>".$user['first_name'] ."</td>
				<td>".$user['insertion'] ."</td>
				<td>".$user['last_name'] ."</td>
				<td>".$user['birthday'] ."</td>
				<td>".$user['email'] ."</td>
				<td>".$user['password'] ."</td>
				<td>".$user['admin'] ."</td>
				<td>".$user['location'] ."</td>
				<td><a href='../users/update_user.php?user_id=".$user["user_id"]."' class='btn btn-info btn-md'>update</a></td>
				<td><a  class='btn btn-info btn-md' id=\"user-delete\" data-target='#delete_confirm".$user['user_id']."' data-toggle='modal'>delete</a></td>
				
				<!-- Modal -->
				<div class=\"modal fade\" id=\"delete_confirm".$user['user_id']."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel\" aria-hidden=\"true\">
				  <div class=\"modal-dialog\" role=\"document\">
					<div class=\"modal-content\">
					  <div class=\"modal-header\">
						<h5 class=\"modal-title\" id=\"exampleModalLabel\">Modal title</h5>
						<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
						  <span aria-hidden=\"true\">&times;</span>
						</button>
					  </div>
					  <div class=\"modal-body\">
						weet je zeker dat je account wilt verwijderen?
					  </div>
					  <div class=\"modal-footer\">
						<button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Close</button>
						<a href='../users/manage_accounts.php?user_id=".$user['user_id']."&method=delete' id='delete-confirm-link' class='btn btn-info btn-md' name='delete'>delete</a>
					  </div>
					</div>
				  </div>
				</div>
				
				");
		echo("</tr>");
	}
			echo"</table>";
	
	?>
	        <a href="../users/add_user.php" class="btn btn-info btn-md">
          <span class="fa fa-plus"></span> Account toevoegen 
        </a>
  Launch demo modal
</button>

			</div>
		</div>
	</div>

<?php include '../include/footer.php'; ?>
</body>
	
</html>