<?php
include '../include/framework.php';

$method = "";
if (isset($_GET["method"])){
	$method = $_GET["method"];
}

//If all the required variables are given
if (isset($_GET["newsarticle_id"]) && isset($_GET["title"]) && isset($_GET["description"]) && $method == "edit") {

	$newsarticle_id = $_GET["newsarticle_id"];
	$name = $_GET["name"];
	$description = $_GET["description"];

	echo EditRights($newsarticle_id, $name, $description); //Calling a function to edit it, which gives back a message if it's successful or not

} elseif(isset($_GET["newsarticle_id"]) && $method == "remove") { //If only a newsarticle_id is given we'll remove it

	$newsarticle_id = $_GET["newsarticle_id"];

	echo RemoveRights($newsarticle_id); //Calling a function to remove it, which gives back a message if it's successful or not
} else {
	echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div>";
}
?>