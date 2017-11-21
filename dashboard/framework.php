<?php

// Function to check if user is in the db with the correct email and password
function CheckIfUserExists($input_email, $input_password)
{
	// DB connection
	include "../database.php";

	// Preparing query
	$query = $conn->prepare("SELECT * FROM persoon WHERE email = ? AND wachtwoord = ?");
	$query->execute(array($input_email, $input_password)); //Putting in the parameters
	$result = $query->fetch(); //Fetching it

	if($query->rowCount() > 0){
		return true;
	} else {
		return false;
	}
}


?>