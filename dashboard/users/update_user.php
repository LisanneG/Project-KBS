<?php
include '../include/framework.php';
include '../include/header.php';

?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<title>Dashboard | Account Updaten</title>
	<?php include '../include/css.php'; ?>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">	
</head>
<body>
<?php include '../include/navbar.php'; ?>
<div class="container">
	<h1>Account Updaten</h1>
	
		<?php 
		
	$user_id="";
	$voornaam="";
	$tussenvoegsel="";
	$achternaam="";
	$verjaardag="";
	$email="";
	$wachtwoord="";
	$locatie="";
	$admin=0;
	
	if(isset($_GET["user_id"]) && $_GET["user_id"] != ""){
	$user_id = $_GET["user_id"];
	
	
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
	/*
	if(isset($_POST["Updaten"]))	{
		$stmt = GetDatabaseConnection()->prepare($sql);
		
		if ($stmt->execute(array($_POST["voornaam"], $_POST["tussenvoegsel"], $_POST["achternaam"], $_POST["verjaardag"], $_POST["email"], $_POST["wachtwoord"], $_POST["admin"], $_POST["locatie"], $user_id))){
			print("<div class=\"alert alert-success\"role=\"alert\">Medewerker succesvol bewerkt</div>");
		}
	}*/

		
		$string = ("SELECT * FROM user WHERE user_id=" . $user_id);
		$query = GetDatabaseConnection()->prepare($string);
		$query->execute();
		if ($row = $query->fetch()) {
			$voornaam = $row["first_name"];
			$tussenvoegsel = $row["insertion"];
			$achternaam = $row["last_name"];
			$geboortedatum = $row["birthday"];
			$email = $row["email"];
			$wachtwoord = $row["password"];
			$admin = $row["admin"];
			$locatie = $row["location"];
		}
			}
		?>

	<div class="container-fluid" style="border: 1px solid #cecece;"	>
	 <form class='form-horizontal' action='manage_accounts.php' method='post'>
	 	<div class='form-group'>
	 	<div class='row'>
	 		<div class='col'>
	 			<input type='text' class='form-control' name='voornaam' value="<?= $voornaam ?>">
	 		</div>
	 		<div class='col'>
	 			<input type='text' class='form-control' placeholder='tussenvoegsel' name='tussenvoegsel'value="<?= $tussenvoegsel ?>">
	 		</div>
	 		<div class='col'>
	 			<input type='text' class='form-control' placeholder='Achternaam' name='achternaam'value="<?= $achternaam ?>">
	 		</div>
	 	</div>
	 	</div>
	 	<div class='form-group'>
	 		<div class='col'>
	 			<input type='date' class='form-control' placeholder='verjaardag' name='verjaardag'value="<?= $geboortedatum ?>">
	 		</div>
	 	</div>
	 	<div class='form-group'>
	 		<div class='col'>
	 			<input type='text' class='form-control' placeholder='Email' name='email'value="<?= $email ?>">
	 		</div>
	 	</div>
	 	<div class='form-group'>
	 		<div class='col'>
	 			<input type='password' class='form-control' Placeholder='Wachtwoord' name='wachtwoord'value="<?= $wachtwoord ?>">
	 		</div>
	 	</div>
	 	<div class='form-group'>
	 			<lable class='control-label col-sm-2'>Admin:</lable>
	 		<div class='col'>
	 			<?php
				if( $admin == 1){
				print	"<input type='checkbox' name='admin' checked>";
				}else{
				print	"<input type='checkbox' name='admin'>";
					
				} ?>
	 		</div>
	 	</div>
	 	<div class='form-group'>
	 		<div class='col'>
	 			<Select class='custom-select' placeholder='Locatie' name='locatie'>
				<?php
				if ($locatie == 1){
				print  "<option>Kies locatie</option>
						<option selected value='1'>Zwolle</option>
						<option value='2'>Nunspeet</option>
						<option value='3'>Nieuwleusen</option>
						<option value='4'>Den Haag</option>
						<option value='5'>Amsterdam</option>
						<option value='6'>Hoogeveen</option>";
				}elseif($locatie == 2){
				print  "<option>Kies locatie</option>
						<option value='1'>Zwolle</option>
						<option selected value='2'>Nunspeet</option>
						<option value='3'>Nieuwleusen</option>
						<option value='4'>Den Haag</option>
						<option value='5'>Amsterdam</option>
						<option value='6'>Hoogeveen</option>";
								
				
				}elseif($locatie == 3){
					print  "<option>Kies locatie</option>
							<option value='1'>Zwolle</option>
							<option value='2'>Nunspeet</option>
							<option selected value='3'>Nieuwleusen</option>
							<option value='4'>Den Haag</option>
							<option value='5'>Amsterdam</option>
							<option value='6'>Hoogeveen</option>";
					
				}elseif($locatie == 4){
					print  "<option>Kies locatie</option>
							<option value='1'>Zwolle</option>
							<option value='2'>Nunspeet</option>
							<option value='3'>Nieuwleusen</option>
							<option selected value='4'>Den Haag</option>
							<option value='5'>Amsterdam</option>
							<option value='6'>Hoogeveen</option>";
					
				}elseif($locatie == 5){
					print  "<option>Kies locatie</option>
							<option value='1'>Zwolle</option>
							<option value='2'>Nunspeet</option>
							<option value='3'>Nieuwleusen</option>
							<option value='4'>Den Haag</option>
							<option selected value='5'>Amsterdam</option>
							<option value='6'>Hoogeveen</option>";
					
				}elseif($locatie == 6){
					print  "<option>Kies locatie</option>
							<option value='1'>Zwolle</option>
							<option value='2'>Nunspeet</option>
							<option value='3'>Nieuwleusen</option>
							<option value='4'>Den Haag</option>
							<option value='5'>Amsterdam</option>
							<option selected value='6'>Hoogeveen</option>";
					
				}else{
					print  "<option selected>Kies locatie</option>
							<option selected value='1'>Zwolle</option>
							<option value='2'>Nunspeet</option>
							<option value='3'>Nieuwleusen</option>
							<option value='4'>Den Haag</option>
							<option value='5'>Amsterdam</option>
							<option value='6'>Hoogeveen</option>";
				
				}
				
				
				?>
	 			</select>
	 	</div>
	 	</br>
		<input type='hidden' name='user_id' value="<?= $user_id ?>">
		
	 	<div class='form-group'>
	 		<div class='col'>
	 			<button type='submit' class='btn btn-primary' name='Updaten'>Updaten</button>
	 		</div>
	 	</div>
	 </form>
	 </div>
	 </div>


<?php

include '../include/footer.php';
?>
</body>
	
</html>