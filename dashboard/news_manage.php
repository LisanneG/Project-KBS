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
	<script src="../js/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>
<body>
  <?php include 'navbar.php'; ?>
  <section id="dashboard-content" class="container-fluid">
	<h2>Beheren nieuwsberichten</h2>
	<ul class="nav nav-tabs">
	  <li class="active"><a data-toggle="tab" href="#toevoegen">Toevoegen</a></li>
	  <li><a data-toggle="tab" href="#wijzigen">Wijzigen</a></li>
	  <li><a data-toggle="tab" href="#verwijderen">Verwijderen</a></li>
	</ul>
	<div class="tab-content">
	  <div id="toevoegen" class="tab-pane fade in active">
		<h3>Toevoegen</h3>
		<form action='news_manage.php' method='POST' enctype='multipart/form-data'>
		<table>
		<tr>
		<td>Titel:</td>
		<td><input type='text' name='title'></td>
		</tr>
		<tr>
		<td>Bestand:</td>
		<td><input type='file' name='fileToUpload' id='fileToUpload'></td>
		<td><input type='submit' value='Upload Image' name='submit'></td>
		</tr>
		<tr>
		<td>Bestandstype:</td>
		<td><select name='filetype'>
		  <option value='image' selected>Afbeelding</option>
		  <option value='PDF'>PDF</option>
		  <option value='video'>Video</option>
		</select></td> 
		</tr>
		</table>
		</form>
	  </div>
	  
	  <div id="wijzigen" class="tab-pane fade">
		<h3>Wijzigen</h3>
		<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
	  </div>
	  
	  <div id="verwijderen" class="tab-pane fade">
		<h3>Verwijderen</h3>
		<p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
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