<?php

include '../include/framework.php';

$method = "";
if (isset($_GET["method"])){
	$method = $_GET["method"];
}

//If all the required variables are given
if (isset($_GET["right_id"]) && isset($_GET["name"]) && isset($_GET["description"]) && $method == "edit") {

	$right_id = $_GET["right_id"];
	$name = $_GET["name"];
	$description = $_GET["description"];

	echo EditRights($right_id, $name, $description); //Calling a function to edit it, which gives back a message if it's successful or not

} elseif(isset($_GET["right_id"]) && $method == "remove") { //If only a right_id is given we'll remove it

	$right_id = $_GET["right_id"];

	echo RemoveRights($right_id); //Calling a function to remove it, which gives back a message if it's successful or not
} else {
	echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fouts gegaan</div>";
}

?>