<?php
function GetDatabaseConnection(){
	try{
		// Setting up the info for the database
		$host = "localhost";
		$username = "root";
		$password = "";
		$db = "dotcasting";
		// Trying to get a connection
		return $conn = new PDO("mysql:dbname=$db;host=$host", $username, $password);
	}
	catch(PDOException $ex){
		// If for some reason the connection can't be made, it will give an error and stop with everything else
		die("<div class='alert alert-danger' role='alert'><strong>Error:</strong> kan geen verbinding maken</div>");
	}
}

//Function to search in the articles
function SearchNewsArticle($search_words){
	//Building the query
	$stringBuilder = "SELECT na.title, na.display_from, na.display_till, na.priority, na.description, f.location, f.`type`, c.name AS category_name, c.background_color, ";
	$stringBuilder .= "MATCH(na.title) AGAINST (? IN BOOLEAN MODE) AS relevanceTitle, ";
	$stringBuilder .= "MATCH(na.description) AGAINST (? IN BOOLEAN MODE) AS relevanceDescription ";
	$stringBuilder .= "FROM news_article na ";
	$stringBuilder .= "LEFT JOIN `file` f ON f.file_id=na.file_id ";
	$stringBuilder .= "INNER JOIN category c ON c.category_id=na.category_id ";
	$stringBuilder .= "WHERE (na.display_till >= NOW() && display_from <= NOW()) ";
	$stringBuilder .= "AND (MATCH(na.title) AGAINST (? IN BOOLEAN MODE) OR MATCH(na.description) AGAINST (? IN BOOLEAN MODE)) ";
	$stringBuilder .= "ORDER BY relevanceTitle, relevanceDescription ";
	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(array($search_words, $search_words, $search_words, $search_words)); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it
	$hasAtLeastOneResult = false;
	$return = "<div class=\"row\">";
	$return .= "	<h3>Nieuwsberichten</h3>";
	$return .= "	<div class=\"col-md-12\">";
	$return .= "		<div class=\"table-responsive\">";
	$return .= "			<table class=\"table\">";
	$return .= "				<thead>";
	$return .= "					<tr>";
	$return .= "						<th>Naam</th>";
	$return .= "						<th class=\"short-description\">Korte beschrijving</th>";
	$return .= "						<th>Weergeef datum</th>";
	$return .= "						<th>Categorie</th>";
	$return .= "						<th>Thumbnail</th>";
	$return .= "					</tr>";	
	$return .= "				</thead>";
	$return .= "				<tbody>";
	
	foreach ($result as $row) {
		$hasAtLeastOneResult = true;
		
		$title = $row["title"];		
		$display_from = $row["display_from"];
		$display_till = $row["display_till"];
		$priority = $row["priority"];
		$description = $row["description"];
		//File
		$location = $row["location"];
		$type = $row["type"];
		//Category
		$category_name = $row["category_name"];
		$color = $row["background_color"];

		$return .= "<tr>";
		$return .= "	<td>$title " . (($priority == 1) ? "<i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i>" : "") . "</td>";
		$return .= "	<td>".substr($description, 0, 150)."...</td>";
		$return .= "	<td>".date("d-m-Y", strtotime($display_from))." t/m ".date("d-m-Y", strtotime($display_till))."</td>";
		$return .= "	<td>$category_name</td>";
		$return .= "	<td>" . (($type == "photo") ? "<img src=\"$location\" alt=\"$title foto\" class=\"img-thumbnail search-img\">" : "N/A") . "</td>";
		$return .= "</tr>";
	}
	$return .= "				</tbody>";
	$return .= "			</table>";	
	$return .= "		</div>";
	$return .= "	</div>";
	$return .= "</div>";

	if(!$hasAtLeastOneResult){
		echo "<div class=\"row\">";
		echo "	<h3>Nieuwsbericht</h3>";
		echo "	<div class=\"col-md-12\">";
		echo "		<div class=\"alert alert-warning\" role=\"alert\">Er zijn geen resultaten voor de nieuwsberichten</div>";
		echo "	</div>";
		echo "</div>";
	} else {
		echo $return;
	}
}
//Function to search in the locations
function SearchLocation($search_words){
	//Building the query
	$stringBuilder = "SELECT l.name, l.address, l.postal_code, l.main_number, l.intern_number, t.name AS category_name, ";
	$stringBuilder .= "MATCH(l.name) AGAINST (? IN BOOLEAN MODE) AS relevanceName ";
	$stringBuilder .= "FROM location l ";
	$stringBuilder .= "LEFT JOIN theme t ON t.theme_id=l.theme_id ";
	$stringBuilder .= "WHERE MATCH(l.name) AGAINST (? IN BOOLEAN MODE) ";
	$stringBuilder .= "ORDER BY relevanceName ";
	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(array($search_words, $search_words)); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it
	$hasAtLeastOneResult = false;
	$return = "<div class=\"row\">";
	$return .= "	<h3>Locaties</h3>";
	$return .= "	<div class=\"col-md-12\">";
	$return .= "	<div class=\"table-responsive\">";
	$return .= "			<table class=\"table\">";
	$return .= "				<thead>";
	$return .= "					<tr>";
	$return .= "						<th>Naam</th>";
	$return .= "						<th>Adres</th>";
	$return .= "						<th>Postcode</th>";
	$return .= "						<th>Hoofdnummer</th>";
	$return .= "						<th>Intern nummer</th>";
	$return .= "						<th>Categorie</th>";
	$return .= "					</tr>";	
	$return .= "				</thead>";
	$return .= "				<tbody>";
	
	foreach ($result as $row) {
		$hasAtLeastOneResult = true;
		
		$name = $row["name"];		
		$address = $row["address"];
		$postal_code = $row["postal_code"];
		$main_number = $row["main_number"];
		$intern_number = $row["intern_number"];
		//Category
		$category_name = $row["category_name"];
		
		$return .= "<tr>";
		$return .= "	<td>$name</td>";
		$return .= "	<td>$address</td>";
		$return .= "	<td>$postal_code</td>";
		$return .= "	<td>$main_number</td>";
		$return .= "	<td>$intern_number</td>";
		$return .= "	<td>$category_name</td>";			
		$return .= "</tr>";
	}
	$return .= "				</tbody>";
	$return .= "			</table>";	
	$return .= "		</div>";
	$return .= "	</div>";
	$return .= "</div>";

	if(!$hasAtLeastOneResult){
		echo "<div class=\"row\">";
		echo "	<h3>Locaties</h3>";
		echo "	<div class=\"col-md-12\">";
		echo "		<div class=\"alert alert-warning\" role=\"alert\">Er zijn geen resultaten voor de locaties</div>";
		echo "	</div>";
		echo "</div>";
	} else {
		echo $return;
	}
}
//Function to search in the accounts
function SearchAccount($search_words){
	$search_words = "\"$search_words\"";

	//Building the query
	$stringBuilder = "SELECT u.first_name, u.insertion, u.last_name, u.birthday, u.email, u.password, u.admin, l.name, f.location AS fileLocation, f.type, ";
	$stringBuilder .= "MATCH(u.first_name) AGAINST (? IN BOOLEAN MODE) AS relevanceFirstname, ";
	$stringBuilder .= "MATCH(u.last_name) AGAINST (? IN BOOLEAN MODE) AS relevanceLastname, ";
	$stringBuilder .= "MATCH(u.email) AGAINST (? IN BOOLEAN MODE) AS relevanceEmail ";
	$stringBuilder .= "FROM `user` u ";
	$stringBuilder .= "LEFT JOIN `file` f ON f.file_id=u.file_id ";
	$stringBuilder .= "INNER JOIN location l ON l.location_id=u.location ";
	$stringBuilder .= "WHERE  ";
	$stringBuilder .= "(MATCH(u.first_name) AGAINST (? IN BOOLEAN MODE) OR MATCH(u.last_name) AGAINST (? IN BOOLEAN MODE) OR MATCH(u.email) AGAINST (? IN BOOLEAN MODE) ) ";
	$stringBuilder .= "ORDER BY relevanceFirstname, relevanceLastname, relevanceEmail ";

	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(array($search_words, $search_words, $search_words, $search_words, $search_words, $search_words)); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it
	$hasAtLeastOneResult = false;
	$return = "<div class=\"row\">";
	$return .= "	<h3>Accounts</h3>";
	$return .= "	<div class=\"col-md-12\">";
	$return .= "	<div class=\"table-responsive\">";
	$return .= "			<table class=\"table\">";
	$return .= "				<thead>";
	$return .= "					<tr>";
	$return .= "						<th>Naam</th>";
	$return .= "						<th>Verjaardag</th>";
	$return .= "						<th>Email</th>";
	$return .= "						<th>Locatie</th>";
	$return .= "						<th>Account type</th>";
	$return .= "						<th>Profiel foto</th>";
	$return .= "					</tr>";	
	$return .= "				</thead>";
	$return .= "				<tbody>";
	
	foreach ($result as $row) {
		$hasAtLeastOneResult = true;
		
		//Putting the name together
		$name = $row["first_name"] . " ";
		
		if($row["insertion"]){
			$name .= $row["insertion"] . " ";
		}

		$name .= $row["last_name"];

		$birthday = $row["birthday"];
		$email = $row["email"];
		$admin = $row["admin"];		
		//File
		$file_location = $row["fileLocation"];
		$type = $row["type"];
		//Location
		$location_name = $row["name"];
		
		$return .= "<tr>";
		$return .= "	<td>$name</td>";
		$return .= "	<td>$birthday</td>";
		$return .= "	<td>$email</td>";
		$return .= "	<td>$location_name</td>";
		$return .= "	<td>" . (($admin == 0) ? "Medewerker" : "Beheerder") . "</td>";
		$return .= "	<td>" . (($type == "photo") ? "<img src=\"$file_location\" alt=\"$name profiel foto\" class=\"img-thumbnail search-img\">" : "N/A") . "</td>";
		$return .= "</tr>";
	}
	$return .= "				</tbody>";
	$return .= "			</table>";	
	$return .= "		</div>";
	$return .= "	</div>";
	$return .= "</div>";

	if(!$hasAtLeastOneResult){
		echo "<div class=\"row\">";
		echo "	<h3>Accounts</h3>";
		echo "	<div class=\"col-md-12\">";
		echo "		<div class=\"alert alert-warning\" role=\"alert\">Er zijn geen resultaten voor de accounts</div>";
		echo "	</div>";
		echo "</div>";
	} else {
		echo $return;
	}
}
//Function to search in the themes
function SearchTheme($search_words){
	//Building the query
	$stringBuilder = "SELECT t.name, f.location, f.`type`, MATCH(t.name) AGAINST (? IN BOOLEAN MODE) AS relevanceName ";
	$stringBuilder .= "FROM theme t ";
	$stringBuilder .= "INNER JOIN `file` f ON f.file_id=t.background_file ";
	$stringBuilder .= "WHERE MATCH(t.name) AGAINST (? IN BOOLEAN MODE) ";
	$stringBuilder .= "ORDER BY relevanceName ";

	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(array($search_words, $search_words)); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it
	$hasAtLeastOneResult = false;
	$return = "<div class=\"row\">";
	$return .= "	<h3>Thema's</h3>";
	$return .= "	<div class=\"col-md-12\">";
	$return .= "	<div class=\"table-responsive\">";
	$return .= "			<table class=\"table\">";
	$return .= "				<thead>";
	$return .= "					<tr>";
	$return .= "						<th>Naam</th>";
	$return .= "						<th>Achtergrond afbeelding</th>";		
	$return .= "					</tr>";	
	$return .= "				</thead>";
	$return .= "				<tbody>";
	
	foreach ($result as $row) {
		$hasAtLeastOneResult = true;
		
		//Putting the name together
		$name = $row["name"];
		$location = $row["location"];
		$type = $row["type"];
		
		$return .= "<tr>";
		$return .= "	<td>$name</td>";
		$return .= "	<td>" . (($type == "photo") ? "<img src=\"$location\" alt=\"Achtergrond afbeelding\" class=\"img-thumbnail search-img\">" : "N/A") . "</td>";
		$return .= "</tr>";
	}
	$return .= "				</tbody>";
	$return .= "			</table>";	
	$return .= "		</div>";
	$return .= "	</div>";
	$return .= "</div>";

	if(!$hasAtLeastOneResult){
		echo "<div class=\"row\">";
		echo "	<h3>Thema's</h3>";
		echo "	<div class=\"col-md-12\">";
		echo "		<div class=\"alert alert-warning\" role=\"alert\">Er zijn geen resultaten voor het thema</div>";
		echo "	</div>";
		echo "</div>";
	} else {
		echo $return;
	}
}
//Function to search in the right
function SearchRight($search_words){
	//Building the query		
	$stringBuilder = "SELECT r.name, r.description, (SELECT COUNT(uhr.user_id) FROM user_has_right uhr WHERE uhr.right_id=r.right_id) as userCount, ";
	$stringBuilder .= "MATCH(r.name) AGAINST (? IN BOOLEAN MODE) AS relevanceName, ";
	$stringBuilder .= "MATCH(r.description) AGAINST (? IN BOOLEAN MODE) AS relevanceDescription ";
	$stringBuilder .= "FROM `right` r ";
	$stringBuilder .= "WHERE (MATCH(r.name) AGAINST (? IN BOOLEAN MODE) OR MATCH(r.description) AGAINST (? IN BOOLEAN MODE)) ";

	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(array($search_words, $search_words, $search_words, $search_words)); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it
	$hasAtLeastOneResult = false;
	$return = "<div class=\"row\">";
	$return .= "	<h3>Rechten</h3>";
	$return .= "	<div class=\"col-md-12\">";
	$return .= "	<div class=\"table-responsive\">";
	$return .= "			<table class=\"table\">";
	$return .= "				<thead>";
	$return .= "					<tr>";
	$return .= "						<th>Naam</th>";
	$return .= "						<th>Beschrijving</th>";
	$return .= "						<th>Hoeveel gebruikers hebben deze recht</th>";
	$return .= "					</tr>";	
	$return .= "				</thead>";
	$return .= "				<tbody>";
	
	foreach ($result as $row) {
		$hasAtLeastOneResult = true;
		
		//Putting the name together
		$name = $row["name"];
		$description = $row["description"];
		$userCount = $row["userCount"];

		$return .= "<tr>";
		$return .= "	<td>$name</td>";
		$return .= "	<td>$description</td>";
		$return .= "	<td>$userCount gebruiker(s)</td>";
		$return .= "</tr>";
	}
	$return .= "				</tbody>";
	$return .= "			</table>";	
	$return .= "		</div>";
	$return .= "	</div>";
	$return .= "</div>";

	if(!$hasAtLeastOneResult){
		echo "<div class=\"row\">";
		echo "	<h3>Rechten</h3>";
		echo "	<div class=\"col-md-12\">";
		echo "		<div class=\"alert alert-warning\" role=\"alert\">Er zijn geen resultaten voor rechten</div>";
		echo "	</div>";
		echo "</div>";
	} else {
		echo $return;
	}
}
//Function to search in the categories
function SearchCategory($search_words){
	//Building the query
	$stringBuilder = "SELECT c.name, c.background_color, MATCH(c.name) AGAINST (? IN BOOLEAN MODE) as relevanceName ";
	$stringBuilder .= "FROM category c ";
	$stringBuilder .= "WHERE MATCH(c.name) AGAINST (? IN BOOLEAN MODE) ";
	$stringBuilder .= "ORDER BY relevanceName ";

	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(array($search_words, $search_words)); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it
	$hasAtLeastOneResult = false;
	$return = "<div class=\"row\">";
	$return .= "	<h3>Categorie&#235;n</h3>";
	$return .= "	<div class=\"col-md-12\">";
	$return .= "	<div class=\"table-responsive\">";
	$return .= "			<table class=\"table\">";
	$return .= "				<thead>";
	$return .= "					<tr>";
	$return .= "						<th>Naam</th>";
	$return .= "						<th>Achtergrond kleur</th>";	
	$return .= "					</tr>";	
	$return .= "				</thead>";
	$return .= "				<tbody>";
	
	foreach ($result as $row) {
		$hasAtLeastOneResult = true;
		
		//Putting the name together
		$name = $row["name"];
		$background_color = $row["background_color"];		

		$return .= "<tr>";
		$return .= "	<td>$name</td>";
		$return .= "	<td style=\"background-color: $background_color;\"></td>";		
		$return .= "</tr>";
	}
	$return .= "				</tbody>";
	$return .= "			</table>";	
	$return .= "		</div>";
	$return .= "	</div>";
	$return .= "</div>";

	if(!$hasAtLeastOneResult){
		echo "<div class=\"row\">";
		echo "	<h3>Categorie&#235;n</h3>";
		echo "	<div class=\"col-md-12\">";
		echo "		<div class=\"alert alert-warning\" role=\"alert\">Er zijn geen resultaten voor de categorie&#235;n</div>";
		echo "	</div>";
		echo "</div>";
	} else {
		echo $return;
	}
}
?>