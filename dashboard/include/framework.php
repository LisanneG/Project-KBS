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

// Function to check if user is in the db with the correct email and password
// Returns false if there isnt any result other wise it returns the results
function CheckIfUserExists($input_email, $input_password)
{
	// Preparing query
	$query = GetDatabaseConnection()->prepare("SELECT admin FROM user WHERE email = ? AND password = ?");
	$query->execute(array($input_email, $input_password)); //Putting in the parameters
	$result = $query->fetch(); //Fetching it

	if($query->rowCount() > 0){		
		return $result;
	} else {
		return false;
	}
}

// Functions for searching

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
		$return .= "	<div class=\"table-responsive\">";
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
			//Relevance
			if(number_format($row["relevanceTitle"], 2) > 0){
				$relevanceTitle = number_format($row["relevanceTitle"], 2);
			} else {
				$relevanceTitle = $row["relevanceTitle"];
			}
			if(number_format($row["relevanceDescription"], 2) > 0){
				$relevanceDescription = number_format($row["relevanceDescription"], 2);
			} else {
				$relevanceDescription = $row["relevanceDescription"];
			}

			$return .= "<tr>";
			$return .= "	<td>$title " . (($priority == 1) ? "<i class=\"fa fa-exclamation-triangle\" aria-hidden=\"true\"></i>" : "") . " ($relevanceTitle%)</td>";
			$return .= "	<td>".substr($description, 0, 150)."... ($relevanceDescription%)</td>";
			$return .= "	<td>".date("d-m-Y", strtotime($display_from))." t/m ".date("d-m-Y", strtotime($display_till))."</td>";
			$return .= "	<td>$category_name</td>";
			$return .= "	<td>" . (($type == "afbeelding") ? "<img src=\"$location\" alt=\"$title foto\" class=\"img-thumbnail search-img\">" : "") . "</td>";
			$return .= "</tr>";
		}

		$return .= "				</tbody>";
		$return .= "			</table>";	
		$return .= "		</div>";
		$return .= "	</div>";
		$return .= "</div>";

		if(!$hasAtLeastOneResult){
			echo "<div class=\"alert alert-warning\" role=\"alert\">Er zijn geen resultaten voor de nieuwsberichten</div>";
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

			//Relevance
			if(number_format($row["relevanceName"], 2) > 0){
				$relevanceName = number_format($row["relevanceName"], 2);
			} else {
				$relevanceName = $row["relevanceName"];
			}
			
			$return .= "<tr>";
			$return .= "	<td>$name ($relevanceName%)</td>";
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

	}

	//Function to search in the themes
	function SearchTheme($search_words){

	}

	//Function to search in the right
	function SearchRight($search_words){

	}

	//Function to search in the categories
	function SearchCategory($search_words){

	}

	//Function to search in the files
	function SearchFile($search_words){

	}

	//Function to search in the layouts
	function SearchLayout($search_words){

	}

// End functions for searching

// Function to get all the locations
// Returns the results
function GetLocations(){
	// Preparing query
	$query = GetDatabaseConnection()->prepare("SELECT location_id, name FROM location");
	$query->execute();
	$result = $query->fetchAll(); //Fetching it

	return $result;
}

// Function to get all the news articles
// Returns the results
function GetNewsArticles($location_id){
	//Building the query
	$stringBuilder = "SELECT na.*, f.location, f.`type`, c.name AS category_name, c.background_color ";
	$stringBuilder .= "FROM news_article na ";
	$stringBuilder .= "LEFT JOIN `file` f ON f.file_id=na.file_id ";
	$stringBuilder .= "INNER JOIN category c ON c.category_id=na.category_id ";
	$stringBuilder .= "WHERE (na.display_till >= NOW() && display_from <= NOW()) ";
	$stringBuilder .= "AND na.news_article_id IN (SELECT nahl.news_article_id FROM news_article_has_location nahl WHERE nahl.location_id=?) ";

	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(array($location_id)); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it

	return $result;
}

// Function to get all the birthdays
// Returns the results
function GetBirthdays($location_id){
	//Building the query
	$stringBuilder = "SELECT b.*, u.first_name, u.insertion, u.last_name, u.birthday, c.name, c.background_color, f.location, f.`type` ";
	$stringBuilder .= "FROM birthday b ";
	$stringBuilder .= "INNER JOIN `user` u ON u.user_id=b.user_id ";
	$stringBuilder .= "LEFT JOIN category c ON c.category_id=b.category_id ";
	$stringBuilder .= "LEFT JOIN `file` f ON f.file_id=b.file_id ";	
	$stringBuilder .= "WHERE u.location=? ";

	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(array($location_id)); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it

	return $result;
}

// Function to get the company logo from the layout
// Returns location from file
function GetLogo(){
	//Building the query
	$stringBuilder = "SELECT f.location ";
	$stringBuilder .= "FROM layout l ";
	$stringBuilder .= "INNER JOIN `file` f ON f.file_id=l.logo ";
	$stringBuilder .= "LIMIT 0,1 ";

	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute();
	$result = $query->fetchAll(); //Fetching it

	$location = "";

	if (isset($result[0]["location"])) {
		$location = $result[0]["location"];
	}

	return "..$location";
}


// Function to get all the users
// Returns result
function GetUsers($NotAdmin){
	$stringBuilder = "SELECT u.user_id, u.email, l.name ";
	$stringBuilder .= "FROM `user` u ";
	$stringBuilder .= "INNER JOIN location l ON l.location_id=u.location ";
	if($NotAdmin){
		$stringBuilder .= "WHERE u.admin=0 ";
	}
	$stringBuilder .= "ORDER BY l.name ";

	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it

	return $result;
}

// Function to get all the rights for a specific user
// Returns result
function GetRights(){
	$stringBuilder = "SELECT r.* ";
	$stringBuilder .= "FROM `right` r ";

	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute();
	$result = $query->fetchAll(); //Fetching it

	return $result;
}

// Function to get all the rights for a specific user
// Returns result
function GetUserRights($user_id){
	$stringBuilder = "SELECT r.*, (SELECT COUNT(uhr.right_id) FROM user_has_right uhr WHERE uhr.user_id=? AND uhr.right_id=r.right_id) AS has_this_right ";
	$stringBuilder .= "FROM `right` r ";

	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(array($user_id)); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it

	return $result;
}

// Function to save all the rights for a specific user
// Returns alert
function SaveUserRights($user_id, $rights){
	//First deleting all the rights
	$stringBuilder = "DELETE FROM user_has_right ";
	$stringBuilder .= "WHERE user_id=? ";

	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	
	$valid = true;

	if($query->execute(array($user_id))){
		//Making the insert query
		$stringBuilder = "INSERT INTO user_has_right (user_id, right_id) VALUES (?,?) ";

		//preparing the query
		$query = GetDatabaseConnection()->prepare($stringBuilder);

		foreach ($rights as $right_id) {

			if($query->execute(array($user_id, $right_id))){
				//
			} else {
				$valid = false;
			}

		}
	} else {
		$valid = false;
	}

	if($valid){
		echo "<div class=\"alert alert-success\" role=\"alert\">Het rechten zijn opgeslagen</div>";
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fouts gegaan</div>";
	}
}

function SaveRights($input_name, $input_description){
	//Making the insert query
	$stringBuilder = "INSERT INTO `right` (name, description) VALUES (?,?) ";

	//preparing the query
	$query = GetDatabaseConnection()->prepare($stringBuilder);

	if($query->execute(array($input_name, $input_description))){
		echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Het recht is opgeslagen</div>";
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fouts gegaan</div>";
	}
}

function EditRights($right_id, $input_name, $input_description){
	//Making the insert query
	$stringBuilder = "UPDATE `right` SET name=?, description=? WHERE right_id=? ";

	//preparing the query
	$query = GetDatabaseConnection()->prepare($stringBuilder);

	if($query->execute(array($input_name, $input_description, $right_id))){
		echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Het recht is bijgewerkt</div>";
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fouts gegaan</div>";
	}
}

function RemoveRights($right_id){
	//Making the insert query
	$stringBuilder = "DELETE FROM `right` WHERE right_id=? ";

	//preparing the query
	$query = GetDatabaseConnection()->prepare($stringBuilder);

	if($query->execute(array($right_id))){
		echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Het recht is verwijderd</div>";
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fouts gegaan</div>";
	}
}
?>