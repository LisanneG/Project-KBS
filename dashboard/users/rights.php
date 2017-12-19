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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard | rechten</title>
	<?php include '../include/css.php'; ?>
</head>
<body>
	<?php include '../include/navbar.php'; ?>
	<!-- Navigational tabs -->
	<section id="dashboard-content" class="container-fluid">
		<h1>Rechten</h1>
		<nav class="nav nav-tabs" id="rightsTab" role="tablist">
			<a class="nav-item nav-link active" id="nav-change-user-rights-tab" data-toggle="tab" href="#nav-change-user-right" role="tab" aria-controls="nav-change-user-right" aria-selected="true">Gebruikers rechten wijzigen</a>
			<a class="nav-item nav-link" id="nav-change-rights-tab" data-toggle="tab" href="#nav-change-rights" role="tab" aria-controls="nav-change-rights" aria-selected="false">Rechten wijzigen</a>			
		</nav>
		
		<!-- content of the tabs -->
		<div class="tab-content" id="nav-tabContent">

			<?php
				//Saving user rights
				if (isset($_POST["save"])) {
					$rights = $_POST["rights"];
					$user_id = $_POST["user_id"];

					SaveUserRights($user_id, $rights);
				}

				//Saving rights
				if (isset($_POST["save_right"])) {
					$name = $_POST["right_name"];
					$description = $_POST["right_description"];

					SaveRights($name, $description);
				}

			?>

			<div id="message"></div>
			
			<!-- content of changing a user rights -->
			<div class="tab-pane fade show active" id="nav-change-user-right" role="tabpanel" aria-labelledby="nav-change-user-right-tab">
				<h3 class="navtabs">Gebruikers rechten</h3>								

				<form method="POST">
					<div class="row">					
						<div class="form-group col-md-12">
							<select class="form-control" id="rights-users" name="user_id">
								<option value="">Kies een gebruiker</option>
								<?php
									foreach (GetUsers(true) as $row) {
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
                                                                            <th>Delete</th>
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
                                            <button type="button" class="btn btn-primary btn-right-add" data-toggle="modal" data-target="#addRight">Recht toevoegen</button>	
                                    </div>
                            </div>		
                    </div>
            </section>	

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
	          		<div class="form-group">
            			<label for="right-name" class="form-control-label">Naam:</label>
	            		<input type="text" class="form-control" id="right-name">
	          		</div>
	          		<div class="form-group">
	            		<label for="right-description" class="form-control-label">Beschrijving:</label>
	            		<textarea class="form-control" id="right-description"></textarea>
	          		</div>		        	
	      		</div>
	      		<div class="modal-footer">
	      			<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
	      			<input type="hidden" id="right-id">
	        		<button type="button" class="btn btn-success" id="save-right-edit">Opslaan</button>
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
	      		<form method="POST">
	      			<div class="modal-body">	        
	          			<div class="form-group">
	            			<label for="right-name" class="form-control-label">Naam:</label>
	            			<input type="text" class="form-control" name="right_name">
	          			</div>
	          			<div class="form-group">
	            			<label for="right-description" class="form-control-label">Beschrijving:</label>
            				<textarea class="form-control" name="right_description"></textarea>
	          			</div>	        
	      			</div>
	     			<div class="modal-footer">
	        			<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
	        			<input type="submit" class="btn btn-success" name="save_right" value="Opslaan">
	      			</div>
      	  		</form>
	    	</div>
		</div>
	</div>

	<!-- Modal for removing right -->
	<div class="modal fade" id="modal-remove-right" tabindex="-1" role="dialog" aria-labelledby="removeRightLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Verwijdern</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Weet jij zeker dat je het recht "<span id="right-title"></span>" wilt verwijderen?</p>
					<input type="hidden" id="right-id">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>	 
					<button type="button" class="btn btn-warning" id="btn-remove-right">Ja</button>	 
				</div>
			</div>
		</div>
	</div>

	<?php include '../include/footer.php'; ?>
</body>
</html>