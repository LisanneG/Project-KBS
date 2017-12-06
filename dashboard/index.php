<?php
session_start();
include 'framework.php';

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
	<title>Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">	
</head>
<body>
	<?php include 'header.php'; ?>
	<section id="dashboard-content" class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<!-- Locatie select -->
				<div class="row justify-content-end">
					<div class="form-group col-md-6">
						<select class="form-control" id="locations">
							<option value="">Kies een locatie</option>
							<?php

								foreach (GetLocations() as $row) {
									$location_id = $row["location_id"];
									$name = $row["name"];

									echo "<option value=\"$location_id\">$name</option>";
								}
								
							?>
						</select>
					</div>
				</div>
				<!-- Berichten -->
				<div id="news-articles"></div>
			</div>
			<div class="col-md-6">
				<div id="weather"></div>
				<div id="birthdays"></div>
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
	<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>