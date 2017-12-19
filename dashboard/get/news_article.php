<?php
include '../include/framework.php';

$method = "";
if (isset($_POST["method"])){
	$method = $_POST["method"];
}

//If all the required variables are given
if (isset(/*$method == "edit"*/ $_FILES["file"]["name"])) {

	//$newsarticle_id = $_GET["newsarticle_id"];
	//$title = $_GET["title"];
	//$description = $_GET["description"];
	//$priority = 
	//$locations = 
	//$locations = explode
	//$display_from = 
	//$display_till =
	//$filelocation = $_GET["file"];

	include '../upload.php';
	//echo EditRights($newsarticle_id, $name, $description); //Calling a function to edit it, which gives back a message if it's successful or not

} elseif(isset($_GET["newsarticle_id"]) && $method == "remove") { //If only a newsarticle_id is given we'll remove it

	$newsarticle_id = $_GET["newsarticle_id"];

	echo RemoveNews($newsarticle_id); //Calling a function to remove it, which gives back a message if it's successful or not
} else {
	echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div>";
}
?>