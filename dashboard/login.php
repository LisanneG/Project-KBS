<?php
// Start the session
session_start();
include 'include/framework.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<?php include 'include/css.php'; ?>
</head>
<body>
	<div class='container' id="login">	
		<div class='row justify-content-center'>
			<div class='col-lg-6'>
				<img src="<?php echo GetLogo(); ?>" class="img-fluid logo" alt="Logo bedrijf">
			</div>
		</div>

		<?php 
			// Set session variables
			if (isset($_POST["submit"])) {
				//Collecting the email and password inputs
				$email = $_POST["email"];
				$input_password = $_POST["password"];	
				
				$result = CheckIfUserExists($email);

				$_SESSION["email"] = "admin@dotcasting.nl";					
				$_SESSION["admin"] = 1;
				$_SESSION["user_id"] = 1;
				header("Location: index.php"); //Redirecting to index.php
				exit();	
				/*
				if($result != false){
					foreach ($result as $row) {
						$user_id = $row["user_id"];
						$admin = $row["admin"];
						$password = $row["password"];

						if (hash_equals($password, crypt($input_password, $password))) {
							// Set session variables
							$_SESSION["email"] = $email;					
							$_SESSION["admin"] = $admin;
							$_SESSION["user_id"] = $user_id;

							header("Location: index.php"); //Redirecting to index.php
							exit();	
						} else {
							echo "<div class='alert alert-danger' role='alert'>Verkeerd wachtwoord of e-mail</div>";
						}

					}
				}*/
			}	
		?>

		<form method="POST">			
			<div class="form-group row justify-content-center">
				<label for="inputEmail3" class="col-sm-2 col-lg-2 form-control-label">E-mail</label>
				<div class="col-sm-10 col-md-10 col-lg-4">
					<input type="email" class="form-control" name="email" placeholder="Email">
				</div>
			</div>
			<div class="form-group row justify-content-center">
				<label for="inputPassword3" class="col-sm-2 form-control-label">Wachtwoord</label>
				<div class="col-sm-10 col-md-10 col-lg-4">
					<input type="password" class="form-control" name="password" placeholder="Wachtwoord">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-1 col-md-2 col-2 offset-md-5 offset-lg-5 login-btn-section">
					<input type="submit" name="submit" value="Log in" class="btn btn-secondary">
				</div>
				<div class="col-lg-2 col-md-3 col-5 password-btn-section">
					<a href="password_forgotten.php" class="btn btn-secondary">Wachtwoord vergeten</a>
				</div>
				<div class="col-lg-1 col-md-1 col-1 question-mark-btn-section">
					<img class='icon-question' src="../img/icons/question-mark.png" data-toggle="popover" title="Inloggen" data-content="Hier komt wat text bla bla bla" data-placement="top">
				</div>
			</div>
		</form>
	</div>	

	<?php include 'include/footer.php'; ?>
</body>
</html>