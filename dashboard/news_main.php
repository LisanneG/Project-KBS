<?php
session_start();
include 'framework.php';
include 'upload.php';

if(!isset($_SESSION["email"])){
	header("Location: login.php"); //Redirecting to login.php
	exit();
}

if (isset($_POST["logout"])) {
	session_destroy(); //Removing the login session

	header("Location: login.php"); //Redirecting to login.php
	exit();
}

if (isset($_POST["filelocation"])) {
	$filelocation = $_POST["filelocation"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Beheer | Nieuwsberichten</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
	<?php include 'navbar.php'; ?>
	
	<!-- Navigational tabs -->
	<section id="dashboard-content" class="container-fluid">
		<h1>Nieuwsberichten</h1>
		<nav class="nav nav-tabs" id="myTab" role="tablist">
			<a class="nav-item nav-link active" id="nav-toevoegen-tab" data-toggle="tab" href="#nav-toevoegen" role="tab" aria-controls="nav-toevoegen" aria-selected="true">Toevoegen</a>
			<a class="nav-item nav-link" id="nav-wijzigen-tab" data-toggle="tab" href="#nav-wijzigen" role="tab" aria-controls="nav-wijzigen" aria-selected="false">Wijzigen</a>
			<a class="nav-item nav-link" id="nav-verwijderen-tab" data-toggle="tab" href="#nav-verwijderen" role="tab" aria-controls="nav-verwijderen" aria-selected="false">Verwijderen</a>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-toevoegen" role="tabpanel" aria-labelledby="nav-toevoegen-tab">
				<?php include 'news/news_add.php' ?>
				<h3 class="navtabs">Nieuw bericht</h3>
				<form action="news_manage.php" method="POST" id="newsAddForm" enctype="multipart/form-data">
					<table>
						<tr>
							<td>Titel:</td>
							<td><input type="text" name="title"></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Bestand:</td>
							<td><input type="file" name="fileToUpload" id="fileToUpload"></td>
							<td><input type="submit" value="Upload Image" name="upload"></td>
						</tr>
						<tr>
							<td>Bestandstype:</td>
							<td><select name="filetype">
								<option value="image" selected>Afbeelding</option>
								<option value="PDF">PDF</option>
								<option value="video">Video</option>
							</select></td> 
						</tr>
						<tr>
							<td>Prioriteit</td>
							<td><input type="checkbox" value="priority" name="priority"></td>
						</tr>
					</table>
					<input type="radio" value="none" name="category" selected>Geen categorie</br>
					<input type="radio" value="administration" name="category">Administratie</br>
					<input type="radio" value="event" name="category">Evenement</br>
					<input type="radio" value="worldnews" name="category">Wereldnieuws</br>
					<input type="radio" value="financial" name="category">Financieel</br>
					<img src="<?= $target_file; ?>" alt="no uploaded file"></br>
					Weergeven op locatie (één of meer):</br>
					<select name="location" multiple>
						<option value="nieuwleusen" selected>Nieuwleusen</option>
						<option value="dalen">Dalen</option>
						<option value="hoogeveen">Hoogeveen</option>
						<option value="nunspeet">Nunspeet</option>
						<option value="zwolle">Zwolle</option>
						<option value="amsterdam">Amsterdam</option>
						<option value="denhaag">Den Haag</option>
					</select></br>
								
					Weergeven op locatie (één of meer):</br>			
					<input type="checkbox" value="nieuwleusen" name="location">Nieuwleusen</br>
					<input type="checkbox" value="dalen" name="location">Dalen</br>
					<input type="checkbox" value="hoogeveen" name="location">Hoogeveen</br>
					<input type="checkbox" value="nunspeet" name="location">Nunspeet</br>
					<input type="checkbox" value="amsterdam" name="location">Amsterdam</br>
					<input type="checkbox" value="zwolle" name="location">Zwolle</br>
					<input type="checkbox" value="denhaag" name="location">Den Haag</br>
					Beschrijving:</br>
					<textarea name="description" rows="5" cols="100" form="newsAddForm">ggwpman</textarea>
					<input type="submit" value="Klaar" name="submit"></br>
					<?= $_POST["description"]; ?>
					<?= $_POST["location"]; ?>
				</form>
			</div>
			<div class="tab-pane fade" id="nav-wijzigen" role="tabpanel" aria-labelledby="nav-wijzigen-tab">
				<?php include 'news/news_edit.php' ?>
			</div>
			<div class="tab-pane fade" id="nav-verwijderen" role="tabpanel" aria-labelledby="nav-verwijderen-tab">
				<?php include 'news/news_remove.php' ?>
			</div>
		</div>
	</section>
	
	
	<img src="../img/dotsolutions-logo.png" alt="dotsolutions logo" class="img-fluid dotsolutions_logo">

	<!-- Modal for logging out -->
	<div class="modal fade" id="modal-logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Uitloggen</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Weet jij zeker dat je wilt uitloggen?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>	 
					<form method="POST">
						<input type="submit" name="logout" class="btn btn-success" value="Uitloggen">
					</form>
				</div>
			</div>
		</div>
	</div>	

	<script src="../js/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</body>
</html>