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
function GetUsers(){
	$stringBuilder = "SELECT u.user_id, u.email, l.name ";
	$stringBuilder .= "FROM `user` u ";
	$stringBuilder .= "INNER JOIN location l ON l.location_id=u.location ";
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
function SaveRights($user_id, $rights){
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
		echo "<div class=\"alert alert-success\" role=\"alert\">De rechten zijn opgeslagen</div>";
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fouts gegaan</div>";
	}
}

?>