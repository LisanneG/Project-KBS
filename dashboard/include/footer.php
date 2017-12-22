<img src="/KBS/Project-KBS/img/dotsolutions-logo.png" alt="dotsolutions logo" class="img-fluid dotsolutions_logo">

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
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>	 
				<form method="POST">
					<input type="submit" name="logout" class="btn btn-success" value="Uitloggen">
				</form>
			</div>
		</div>
	</div>
</div>

	<!-- Modal for user edit -->
<div class="modal fade" id="modal-user-edit" tabindex="-1" role="dialog" aria-labelledby="userEditLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="userEditLabel">Gebruikers informatie</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<div class="modal-body">								
				<?php
					if(isset($_SESSION["user_id"])){
						$user_id = $_SESSION["user_id"];

						//Building the query
						$stringBuilder = "SELECT u.*, f.location, l.name AS location_name ";
						$stringBuilder .= "FROM `user` u ";
						$stringBuilder .= "LEFT JOIN `file` f ON f.file_id=u.file_id AND f.`type` = 'photo' ";
						$stringBuilder .= "INNER JOIN location l ON l.location_id=u.location ";
						$stringBuilder .= "WHERE u.user_id=? ";

						// Preparing query
						$query = GetDatabaseConnection()->prepare($stringBuilder);
						$query->execute(array($user_id)); //Putting in the parameters
						$result = $query->fetchAll(); //Fetching it				

						foreach ($result as $row) {
							//Putting the name together
							$name = $row["first_name"] . " ";
							
							if($row["insertion"]){
								$name .= $row["insertion"] . " ";
							}

							$name .= $row["last_name"];

							$birthday = $row["birthday"];
							$email = $row["email"];
							$admin = $row["admin"];			
							//Profile pic
							$profile_pic = $row["location"];
							//Location
							$location_name = $row["location_name"];

							?>
								<div class="form-group">
									<label for="right-name" class="form-control-label">Naam</label>
									<input type="text" class="form-control" disabled name="user_name" value="<?php echo $name ?>">
								</div>
								<div class="form-group">
									<label for="right-description" class="form-control-label">Geboortedatum:</label>	            		
									<input type="text" class="form-control" disabled name="user_birthday" value="<?php echo $birthday ?>">
								</div>
								<div class="form-group">
									<label for="right-description" class="form-control-label">E-mail:</label>	            		
									<input type="text" class="form-control" disabled name="user_email" value="<?php echo $email ?>">
								</div>
								<div class="form-group">
									<label for="right-description" class="form-control-label">Locatie:</label>	            		
									<input type="text" class="form-control" disabled name="user_location" value="<?php echo $location_name ?>">
								</div>
								<div class="form-group">
									<label for="right-description" class="form-control-label">Wachtwoord:</label>
									<form method="POST">
										<div class="row">
											<div class="col-md-8">
												<input type="password" class="form-control" name="user_password">		
											</div>
											<div class="col-md-4">
												<input type="submit" class="form-control" name="change_pass" value="Veranderen">
											</div>
										</div>
									</form>																			
								</div>									
								<div class="form-group">
									<label for="right-description" class="form-control-label">Profiel foto:</label>
									<form method="POST" enctype="multipart/form-data">
										<div class="row">
											<?php 
												if($profile_pic != ""){
													echo "<div class=\"col-md-8\">";
													echo "	<img src=\"$profile_pic\" class=\"img-fluid img-thumbnail\">";
													echo "</div>";
													echo "<div class=\"col-md-4\">";
													echo "	<input type=\"submit\" class=\"form-control btn btn-danger\" name=\"remove_pic\" value=\"Verwijderen\">";
													echo "</div>";
												}
											?>
											<div class="col-md-8">
												<input class="btn btn-default" type="file" name="user_profile_pic">
											</div>
											<div class="col-md-4">
												<input type="submit" class="form-control" name="change_pic" value="Veranderen">
											</div>
										</div>
									</form>
								</div>									
							<?php
						}							
					}
				?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>			
				</div>
		</div>
	</div>
</div>

<?php

//when the change password button is clicked
if (isset($_POST["change_pass"])) {
	$password = $_POST["user_password"];
	$user_id = $_SESSION["user_id"];

	//Creating a hashed password
	$size = mcrypt_get_iv_size(MCRYPT_CAST_256, MCRYPT_MODE_CFB);
	$iv = mcrypt_create_iv($size, MCRYPT_DEV_RANDOM);
	$hashed_password = crypt($password, $iv);

	//Making the insert query for the user
	$stringBuilder = "UPDATE `user` SET password=? WHERE user_id=? ";
	//preparing the query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	if($query->execute(array($hashed_password, $user_id))){
		echo "<div class=\"container-fluid\"><div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Wachtwoord is gewijzigd</div></div>";
	} else {
		echo "<div class=\"container-fluid\"><div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div></div>";				
	}
}

//When the submit button for changing/adding a pic is clicked
if (isset($_POST["change_pic"])) {	
	include '../database.php';

	//The available extentions for the pics
	$imageList = array("png", "jpeg", "jpg", "gif");
	
    $medium = str_replace(" ", "_", $_FILES["user_profile_pic"]["name"]);
    $ext = pathinfo($medium, PATHINFO_EXTENSION);

    if (in_array($ext, $imageList)) {
        //4 random numbers before filename for identification		
		$digits = 4;
		$prename = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
		
		$server_url = "/KBS/Project-KBS/bestanden/media/photo/" . $prename . $medium;
		$url = $_SERVER["DOCUMENT_ROOT"] . "/KBS/Project-KBS/bestanden/media/photo/" . $prename . $medium;	
		
	    if (move_uploaded_file($_FILES["user_profile_pic"]["tmp_name"], $url)) {
			$stmt = $conn->prepare("INSERT INTO file (location, type) VALUES (?,?)");
			$stmt->execute(array($server_url, "photo"));
			$file_id = $conn->lastInsertId();

			//Making the insert query for the user
			$stringBuilder = "UPDATE `user` SET file_id=? WHERE user_id=? ";
			//preparing the query
			$query = GetDatabaseConnection()->prepare($stringBuilder);
			if($query->execute(array($file_id, $_SESSION["user_id"]))){
				echo "<div class=\"container-fluid\"><div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Profiel foto is bewerkt/toegevoegd</div></div>";
			} else {
				echo "<div class=\"container-fluid\"><div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div></div>";				
			}
		} else {
			echo "<div class=\"container-fluid\"><div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div></div>";
		}
    } else {
    	echo "<div class=\"container-fluid\"><div class=\"alert alert-warning\" role=\"alert\">Het geuploade bestand is geen afbeelding png, jpeg, jpg of gif</div></div>";
    }	
}

//When the submit button for removing a pic is clicked
if(isset($_POST["remove_pic"])){
	include '../database.php';
	
	$user_id = $_SESSION["user_id"];

	//Making a query to get the location of the file	
	$stringBuilder = "SELECT f.location, f.file_id ";
	$stringBuilder .= "FROM `user` u ";
	$stringBuilder .= "INNER JOIN `file` f ON f.file_id=u.file_id ";
	$stringBuilder .= "WHERE u.user_id=? ";

	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(array($user_id)); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it				

	foreach ($result as $row) {
		//Putting the name together
		$file_location = $_SERVER["DOCUMENT_ROOT"] . $row["location"];
		$file_id = $row["file_id"];

		if (unlink($file_location)){
			//First setting the file_id to null in the user table
			$stringBuilder = "UPDATE `user` SET file_id = NULL WHERE user_id=? ";

			$query = GetDatabaseConnection()->prepare($stringBuilder);
			if($query->execute(array($user_id))){ //After this succeeded we'll remove the file in the database				
				$stringBuilder = "DELETE FROM `file` WHERE file_id=? ";
				//preparing the query
				$query = GetDatabaseConnection()->prepare($stringBuilder);
				if($query->execute(array($file_id))){
					echo "<div class=\"container-fluid\"><div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Profiel foto is verwijderd</div></div>";
				} else {
					echo "<div class=\"container-fluid\"><div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div></div>";
				}
			} else {
				echo "<div class=\"container-fluid\"><div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div></div>";				
			}				
		}
	}
}
?>

<script src="/KBS/Project-KBS/js/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script type="text/javascript" src="/KBS/Project-KBS/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/KBS/Project-KBS/js/script.js"></script>