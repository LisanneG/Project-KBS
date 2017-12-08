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
				<a href="/KBS/Project-KBS/dashboard/"><img src="<?php echo GetLogo(); ?>" class="img-fluid logo" alt="Responsive image"></a>
			</div>
		</div>

		<form method="POST">			
			<div class="form-group row justify-content-center">
				<label for="inputEmail3" class="col-sm-2 col-lg-2 form-control-label">E-mail</label>
				<div class="col-sm-10 col-md-10 col-lg-4">
					<input type="email" class="form-control" name="email" placeholder="Email">
				</div>
			</div>
			<div class="form-group row">
				<div class="col-lg-4 col-md-8 col-10 offset-md-2 offset-lg-5 login-btn-section">
					<input type="submit" name="submit" value="Verstuur mail" class="btn btn-secondary btn-password-forgotten">
				</div>				
				<div class="col-lg-1 col-md-1 col-1 question-mark-btn-section">
					<img class='icon-question' src="../img/icons/question-mark.png" data-toggle="popover" title="Wachtwoord vergeten" data-content="Je krijgt een mailtje met een nieuw wachtwoord om in te loggen" data-placement="top">
				</div>
			</div>
		</form>
	</div>	

	<img src="../img/dotsolutions-logo.png" alt="dotsolutions logo" class="img-fluid dotsolutions_logo">

	<?php include 'include/js.php'; ?>
</body>
</html>