<?php
include '../include/framework.php';

$method = "";
if (isset($_POST["method"])){
	$method = $_POST["method"];
}

//If all the required variables are given
if (isset(/*$method == "edit"*/ $_FILES["file"]["name"])) {
														//fix the stuff for files as soon as that works!
	$newsarticle_id = $_POST["newsarticle_id"];
	$news_title = htmlentities($_POST["news-title"]);
	$categoryId = $_POST["news-category"];
	//$fileId = $lastInsertedFileId[0];
	$displayFrom = $_POST["news-date-from"];
	$displayTill = $_POST["news-date-till"];
	if (isset($_POST["news-priority"])) {
		$priority = 1;
	} else {
		$priority = 0;
	}
	$description = htmlentities($_POST["news-description"]); 
	$locations = $_POST["locations"];
	
	//$newsarticle_id = $_GET["newsarticle_id"];
	//$title = $_GET["title"];
	//$description = $_GET["description"];
	//$priority = 
	//$locations = 
	//$locations = explode
	//$display_from = 
	//$display_till =
	//$filelocation = $_GET["file"];

	//include '../upload.php';
	echo EditNews($newsarticle_id, $news_title, $categoryId, $displayFrom, $displayTill, $priority, $description); //Calling a function to edit it, which gives back a message if it's successful or not

} elseif(isset($_GET["newsarticle_id"]) && $method == "remove") { //If only a newsarticle_id is given we'll remove it

	$newsarticle_id = $_GET["newsarticle_id"];

	echo RemoveNews($newsarticle_id); //Calling a function to remove it, which gives back a message if it's successful or not
} else {
	echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div>";
}
?>