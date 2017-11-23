<?php

// Function to check if user is in the db with the correct email and password
// Returns false if there isnt any result other wise it returns the results
function CheckIfUserExists($input_email, $input_password)
{
	// DB connection
	include "../database.php";

	// Preparing query
	$query = $conn->prepare("SELECT admin FROM persoon WHERE email = ? AND wachtwoord = ?");
	$query->execute(array($input_email, $input_password)); //Putting in the parameters
	$result = $query->fetch(); //Fetching it

	print_r($result);

	if($query->rowCount() > 0){		
		return $result;
	} else {
		return false;
	}
}


?>