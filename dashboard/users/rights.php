<?php
session_start();
include '../framework.php';

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
	<title>Dashboard | rechten</title>
	<link rel="stylesheet" type="text/css" href="../../css/style.css">
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">	
</head>
<body>
	<?php include '../header.php'; ?>
	<!-- Navigational tabs -->
	<section id="dashboard-content" class="container-fluid">
		<h1>Rechten</h1>
		<nav class="nav nav-tabs" id="rightsTab" role="tablist">
			<a class="nav-item nav-link active" id="nav-change-user-rights-tab" data-toggle="tab" href="#nav-change-user-right" role="tab" aria-controls="nav-change-user-right" aria-selected="true">Gebruikers rechten wijzigen</a>
			<a class="nav-item nav-link" id="nav-change-rights-tab" data-toggle="tab" href="#nav-change-rights" role="tab" aria-controls="nav-change-rights" aria-selected="false">Rechten wijzigen</a>			
		</nav>
		
		<!-- content of the tabs -->
		<div class="tab-content" id="nav-tabContent">
			
			<!-- content of changing a user rights -->
			<div class="tab-pane fade show active" id="nav-change-user-right" role="tabpanel" aria-labelledby="nav-change-user-right-tab">
				<h3 class="navtabs">Gebruikers rechten</h3>				
				<?php
					if (isset($_POST["save"])) {
						$rights = $_POST["rights"];
						$user_id = $_POST["user_id"];

						saveRights($user_id, $rights);
					}

				?>

				<form method="POST">
					<div class="row">					
						<div class="form-group col-md-12">
							<select class="form-control" id="rights-users" name="user_id">
								<option value="">Kies een gebruiker</option>
								<?php
									foreach (GetUsers() as $row) {
										$user_id = $row["user_id"];
										$email = $row["email"];
										$name = $row["name"];

										echo "<option value=\"$user_id\">$email ($name)</option>";
									}

								?>
							</select>
						</div>
						<div id="user-rights-table" class="col-md-12">
							<table class="table">
								<thead>
									<tr>
										<th>Checkbox</th>
										<th>Naam</th>
										<th>Beschrijving</th>							
									</tr>
								</thead>
								<tbody id="user-rights-tbody">
								</tbody>
							</table>
							<input type="submit" name="save" class="btn btn-success" value="Opslaan">
						</div>					
					</div>
				</form>
							
			</div>
			
			<!-- content of changing rights -->
			<div class="tab-pane fade" id="nav-change-rights" role="tabpanel" aria-labelledby="nav-change-rights-tab">
				<div class="row">					
					<div class="col-md-12">
						<table class="table">
							<thead>
								<tr>								
									<th>Naam</th>
									<th>Beschrijving</th>							
								</tr>
							</thead>
							<tbody id="rights-tbody">
							</tbody>
						</table>	
					</div>					
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addRight">Recht toevoegen</button>	
				</div>
			</div>		
		</div>
	</section>

	<img src="../../img/dotsolutions-logo.png" alt="dotsolutions logo" class="img-fluid dotsolutions_logo">

	<!-- Modal for editing right -->
	<div class="modal fade" id="editRight" tabindex="-1" role="dialog" aria-labelledby="editRightLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="editRightLabel">Bewerken recht</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
	          <div class="form-group">
	            <label for="right-name" class="form-control-label">Naam:</label>
	            <input type="text" class="form-control" id="right-name">
	          </div>
	          <div class="form-group">
	            <label for="right-description"" class="form-control-label">Beschrijving:</label>
	            <textarea class="form-control" id="right-description"></textarea>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
	        <button type="button" class="btn btn-success">Opslaan</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal for adding right -->
	<div class="modal fade" id="addRight" tabindex="-1" role="dialog" aria-labelledby="addRightLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="addRightLabel">Toevoegen recht</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form>
	          <div class="form-group">
	            <label for="right-name" class="form-control-label">Naam:</label>
	            <input type="text" class="form-control" id="right-name">
	          </div>
	          <div class="form-group">
	            <label for="right-description"" class="form-control-label">Beschrijving:</label>
	            <textarea class="form-control" id="right-description"></textarea>
	          </div>
	        </form>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
	        <button type="button" class="btn btn-success">Opslaan</button>
	      </div>
	    </div>
	  </div>
	</div>

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

	<script src="../../js/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../../js/script.js"></script>
</body>
</html>