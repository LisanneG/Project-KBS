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
	$stringBuilder = "SELECT na.*, f.location, f.`type`, c.name AS category_name, c.color, l.name AS location_name, l.address, l.postal_code, l.main_number, l.intern_number ";
	$stringBuilder .= "FROM news_article na ";
	$stringBuilder .= "LEFT JOIN `file` f ON f.file_id=na.file_id ";
	$stringBuilder .= "INNER JOIN category c ON c.category_id=na.category_id ";
	$stringBuilder .= "INNER JOIN location l ON l.location_id=na.location_id ";
	$stringBuilder .= "WHERE (na.display_till >= NOW() && display_from <= NOW()) ";
	$stringBuilder .= "AND l.location_id=? ";

	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(array($location_id)); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it

	return $result;
}

?>