<?php
session_start();
$success = 0;
include 'framework.php';
include '../database.php';
include 'upload.php';
include 'news/news_send.php';
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
	
	<!-- Alerts for success & failure -->
	<?php 
	if (isset($_POST["submit"])) {
		if ($success == 1) {
			print("<div class='alert alert-success' role='alert'>Nieuwsbericht succesvol toegevoegd</div>");
		} elseif ($success == 0) {
			print("<div class='alert alert-danger' role='alert'>Er is iets fout gegaan, nieuwsbericht is niet toegevoegd</div>");
		}
	}
	?>
	
	<!-- Navigational tabs -->
	<section id="dashboard-content" class="container-fluid">
		<h1>Nieuwsberichten</h1>
		<nav class="nav nav-tabs" id="myTab" role="tablist">
			<a class="nav-item nav-link active" id="nav-toevoegen-tab" data-toggle="tab" href="#nav-toevoegen" role="tab" aria-controls="nav-toevoegen" aria-selected="true">Toevoegen</a>
			<a class="nav-item nav-link" id="nav-wijzigen-tab" data-toggle="tab" href="#nav-wijzigen" role="tab" aria-controls="nav-wijzigen" aria-selected="false">Wijzigen</a>
			<a class="nav-item nav-link" id="nav-verwijderen-tab" data-toggle="tab" href="#nav-verwijderen" role="tab" aria-controls="nav-verwijderen" aria-selected="false">Verwijderen</a>
		</nav>
		
		<!-- content of the tabs -->
		<div class="tab-content" id="nav-tabContent">
			
			<!-- content of "toevoegen" -->
			<div class="tab-pane fade show active" id="nav-toevoegen" role="tabpanel" aria-labelledby="nav-toevoegen-tab">
				<h3 class="navtabs">Nieuw bericht</h3>
				<form action="news_main.php" method="POST" id="newsAddForm" enctype="multipart/form-data">
					<div class="form-group row">
						<label class="control-label col-2 col-form-label" for="title">Title:</label>
						<div class="col-10">
							<input type="text" class="form-control" id="title" placeholder="Enter title" name="title" required="required">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-2 col-form-label" for="file">Bestand(en):</label>
						<div class="col-10">
							<input class="btn btn-default" id="file" type="file" name="medium[]" required="required">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-2" for="priority">Prioriteit:</label>
						<div class="col-10">
							<input class="mr-1" type="checkbox" id="priority" name="priority">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-2" for="dateFrom">Datum van:</label>
						<div class="col-10">
							<input type="date" id="dateFrom" name="dateFrom" required="required">
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-2" for="dateTill">Datum tot:</label>
						<div class="col-10">
							<input type="date" id="dateTill" name="dateTill" required="required">
						</div>
					</div>
					
					<?php include 'news/news_add.php' ?>
					
					<div class="form-group row">
						<label class="control-label col-2 col-form-label" for="description">Beschrijving:</label>
						<div class="col-10">
							<textarea name="description" class="form-control" id="description" form="newsAddForm"></textarea>
						</div>
					</div>
					<div class="form-group row">
						<div class="mr-auto col-10">
							<button type="submit" class="btn btn-default" name="submit" >Submit</button>
						</div>
					</div>
				</form>
			</div>
			
			<!-- content of "wijzigen" -->
			<div class="tab-pane fade" id="nav-wijzigen" role="tabpanel" aria-labelledby="nav-wijzigen-tab">
				<?php include 'news/news_edit.php' ?>
			</div>
			
			<!-- content of "verwijderen" -->
			<div class="tab-pane fade" id="nav-verwijderen" role="tabpanel" aria-labelledby="nav-verwijderen-tab">
				<?php include 'news/news_remove.php' ?>
			</div>
		</div>
	</section>
	
	
	
	
	<!-- <img src="../img/dotsolutions-logo.png" alt="dotsolutions logo" class="img-fluid dotsolutions_logo"> -->

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