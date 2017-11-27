<?php echo '
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
				<li class="nav-item"><a class="nav-link icon-settings" href="#"><img src="../img/icons/settings.png" alt="Settings icon"></a></li>
				<li class="nav-item"><button type="button" class="btn" data-toggle="modal" data-target="#modal-logout">Uitloggen</button></li>
			</ul>	
		</div>
	</nav>';
?>