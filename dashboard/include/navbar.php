<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  		<a class="navbar-brand" href="/KBS/Project-KBS/dashboard/index.php">Dotcasting</a>
  		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    		<span class="navbar-toggler-icon"></span>
  		</button>

	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
	    	<ul class="navbar-nav mr-auto">
	      		<li class="nav-item dropdown">
			        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Beheer</a>
			        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			        	<a class="dropdown-item" href="/KBS/Project-KBS/dashboard/news_main.php">Nieuwsbericht</a>
			        	<a class="dropdown-item" href="/KBS/Project-KBS/dashboard/location/location_main.php">Locaties</a>			        	
			    	</div>
				</li>
				<?php if (isset($_SESSION["admin"]) && $_SESSION["admin"] == "1") { ?>			
					<li class="nav-item dropdown">
				        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
				        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
				        	<a class="dropdown-item" href="/KBS/Project-KBS/dashboard/users/manage_accounts.php">Medewerkers</a>
				        	<a class="dropdown-item" href="/KBS/Project-KBS/dashboard/users/rights.php">Rechten</a>			        	
				    	</div>
					</li>
				<?php } ?>		      
		      	<form class="form-inline" id="search-section" method="POST" action="search.php">
				    <div class="input-group">
				    	<button class="input-group-addon" id="basic-addon1"><i class="fa fa-search" aria-hidden="true"></i></button>
				    	<input type="text" class="form-control" name="search-words" placeholder="Search" aria-label="Search" aria-describedby="basic-addon1">				    	
				    	<select class="form-control" name="search-section">
				    		<option value="">Alles</option>
				    		<option <?php IsSelected("news"); ?> value="news_article">Nieuwsberichten</option>
				    		<option <?php IsSelected("locations"); ?> value="location">Locaties</option>
				    		<option <?php IsSelected("manage_accounts"); ?> value="account">Accounts</option>
				    		<option <?php IsSelected("themes"); ?> value="theme">Thema's</option>
				    		<option <?php IsSelected("rights"); ?> value="right">Rechten</option>
				    		<option <?php IsSelected("categories"); ?> value="category">Categorie</option>
				    	</select>
				    	
				    	<?php
				    		function IsSelected($page){
				    			$url = $_SERVER['PHP_SELF'];

				    			if (strpos($url, $page) !== false) {
									echo "selected";
								}				    			
				    		}

				    	?>
				    </div>
				</form>	      		      	
	    	</ul>	    
	    	<ul class="navbar-nav">
				<li class="nav-item welcome-message">Welkom: <?php echo $_SESSION["email"]; ?></li>
				<li class="nav-item">
					<button type="button" class="nav-link icon-settings btn btn-link" data-toggle="modal" data-target="#modal-user-edit"><i class="fa fa-cog" aria-hidden="true"></i></button>			    	
			  	</li>
			  	<li class="nav-item">
		  			<button type="button" class="btn" data-toggle="modal" data-target="#modal-logout">Uitloggen</button>			    	
			  	</li>
			</ul>	
	  	</div>
	</nav>
</header>