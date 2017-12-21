<?php
include '../include/framework.php';
include '../include/header.php';
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
	<form class="form-horizontal" action="manage_accounts.php" method="post">
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



	<?php include '../include/footer.php'; ?>
</body>
	
</html>