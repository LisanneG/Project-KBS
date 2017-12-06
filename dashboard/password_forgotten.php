<?php
// Start the session
session_start();
include 'framework.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">	
</head>
<body>
	<div class='container' id="login">	
		<div class='row justify-content-center'>
			<div class='col-lg-6'>
				<img src="<?php echo GetLogo(); ?>" class="img-fluid logo" alt="Responsive image">
			</div>
		</div>

		<?php 						
			if (isset($_POST["submit"])) {
				//Collecting the email and password inputs
				$email = $_POST["email"];
				$password = $_POST["password"];	

				$admin = CheckIfUserExists($email, $password);

				if($admin != false){					
					// Set session variables
					$_SESSION["email"] = $email;
					$_SESSION["admin"] = $admin[0];

					header("Location: index.php"); //Redirecting to index.php
					exit();
				} else {
					echo "<div class='alert alert-danger' role='alert'>Verkeerd wachtwoord of e-mail</div>";
				}
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
					<button class="btn btn-secondary">Wachtwoord vergeten</button>
				</div>
				<div class="col-lg-1 col-md-1 col-1 question-mark-btn-section">
					<img class='icon-question' src="../img/icons/question-mark.png" data-toggle="popover" title="Inloggen" data-content="Hier komt wat text bla bla bla" data-placement="top">
				</div>
			</div>
		</form>
	</div>	

	<img src="../img/dotsolutions-logo.png" alt="dotsolutions logo" class="img-fluid dotsolutions_logo">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<script src="../js/script.js" type="text/javascript"></script>
</body>
</html>