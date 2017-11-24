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
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<a class="navbar-brand" href="index.php">Dotcasting</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	<ul class="navbar-nav mr-auto">
	      		<li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Beheer</a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			        	<a class="dropdown-item" href="#">Nieuwsbericht</a>			        	
			        	<a class="dropdown-item" href="#">Weerbericht</a>
			        	<a class="dropdown-item" href="#">Calender</a>
			    	</div>
				</li>
				<?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] == "1") { ?>			
					<li class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				        	<a class="dropdown-item" href="#">Medewerkers</a>
				        	<a class="dropdown-item" href="#">Rechten</a>			        	
				    	</div>
					</li>
				<?php } ?>
		      	<li class="nav-item"><a class="nav-link" href="#">Locaties</a></li>
		      	<li class="nav-item"><a class="nav-link" href="#">Schermen</a></li>		      	
		      	<form class="form-inline" id="search-section">
				    <div class="input-group">
				    	<button class="input-group-addon" id="basic-addon1"><img src="../img/icons/searcher.png" alt="Search icon"></button>
				    	<input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">
				    </div>
				</form>	      		      	
	    	</ul>	    
	    	<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="#">Welkom: <?php echo $_SESSION["email"]; ?></a></li>
				<li class="nav-item">
			    	<a class="nav-link icon-settings" href="#"><img src="../img/icons/settings.png" alt="Settings icon"></a>
			  	</li>
			  	<li class="nav-item">
		  			<button type="button" class="btn" data-toggle="modal" data-target="#modal-logout">Uitloggen</button>			    	
			  	</li>
			</ul>	
	  	</div>
	</nav>

	<section id="dashboard-content" class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<!-- Locatie select -->
				<div class="row justify-content-end">
					<div class="form-group col-md-4">
						<select class="form-control" id="locations">
							<option value="1">locatie 1</option>
							<option value="2">locatie 2</option>
							<option value="3">locatie 3</option>
						</select>
					</div>
				</div>
				<!-- Berichten -->
				<div class="row">
					<div class="col-md-12 news-section">
						<p class='title'>Title</p>
						<div class="row">
							<div class="col-md-12 text-right">
								<img src="../img/icons/dots.png">
							</div>
							<div class="col-md-6">
								<p>Lorem ipsum dolor sit amet, veri corpora in sea. Veri summo ea nam, et omnis habemus lucilius nec. Per ex accusam facilisi patrioque, facete feugait te vis. Pri ne sumo vulputate. Latine accusam fabellas cu mei. Cum eros consul accusamus ea, mei idque feugiat prodesset te, latine nominavi nominati ut pro. Et sint legere similique has, eum te luptatum democritum consectetuer, solet incorrupte vim at. An eum diam legimus offendit, te nec ipsum eligendi constituto. Cum ea electram sapientem adipiscing. Ea eros essent cum.</p>
							</div>
							<div class="col-md-6 text-right">								
								<img src="http://image.shutterstock.com/z/stock-photo-this-mutated-and-mutilated-human-has-his-feet-on-his-hands-64680841.jpg" class="img-thumbnail news-image" alt="Nieuwsbrief foto">
							</div>						
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 news-section">
						<p class='title'>Title</p>
						<div class="row">
							<div class="col-md-12 text-right">
								<img src="../img/icons/dots.png">
							</div>
							<div class="col-md-6">
								<p>Lorem ipsum dolor sit amet, veri corpora in sea. Veri summo ea nam, et omnis habemus lucilius nec. Per ex accusam facilisi patrioque, facete feugait te vis. Pri ne sumo vulputate. Latine accusam fabellas cu mei. Cum eros consul accusamus ea, mei idque feugiat prodesset te, latine nominavi nominati ut pro. Et sint legere similique has, eum te luptatum democritum consectetuer, solet incorrupte vim at. An eum diam legimus offendit, te nec ipsum eligendi constituto. Cum ea electram sapientem adipiscing. Ea eros essent cum.</p>
							</div>
							<div class="col-md-6 text-right">								
								<img src="http://image.shutterstock.com/z/stock-photo-this-mutated-and-mutilated-human-has-his-feet-on-his-hands-64680841.jpg" class="img-thumbnail news-image" alt="Nieuwsbrief foto">
							</div>						
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 news-section">
						<p class='title'>Title</p>
						<div class="row">
							<div class="col-md-12 text-right">
								<img src="../img/icons/dots.png">
							</div>
							<div class="col-md-6">
								<p>Lorem ipsum dolor sit amet, veri corpora in sea. Veri summo ea nam, et omnis habemus lucilius nec. Per ex accusam facilisi patrioque, facete feugait te vis. Pri ne sumo vulputate. Latine accusam fabellas cu mei. Cum eros consul accusamus ea, mei idque feugiat prodesset te, latine nominavi nominati ut pro. Et sint legere similique has, eum te luptatum democritum consectetuer, solet incorrupte vim at. An eum diam legimus offendit, te nec ipsum eligendi constituto. Cum ea electram sapientem adipiscing. Ea eros essent cum.</p>
							</div>
							<div class="col-md-6 text-right">								
								<img src="http://image.shutterstock.com/z/stock-photo-this-mutated-and-mutilated-human-has-his-feet-on-his-hands-64680841.jpg" class="img-thumbnail news-image" alt="Nieuwsbrief foto">
							</div>						
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				
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