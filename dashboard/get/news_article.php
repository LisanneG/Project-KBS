<?php
include '../include/framework.php';

$method = "";
if (isset($_POST["method"])){
	$method = $_POST["method"];
}
//If all the required variables are given
if ($method === "edit") {
	
	//removing old file
	if ($_FILES["file"]["name"] != ""){
		include '../../database.php';
		$newsarticle_id = $_POST["newsarticle_id"];
		$stmt = $conn->prepare("SELECT file_id FROM news_article WHERE news_article_id=$newsarticle_id");
		$stmt->execute();
		$result = $stmt->fetch();
		$fileIdOld = $result["file_id"];
		
		$stmt = $conn->prepare("SELECT * FROM file WHERE file_id=$fileIdOld");
		$stmt->execute();
		$result = $stmt->fetch();
		$filelocation = $result["location"];
		
		$filelocation = $_SERVER["DOCUMENT_ROOT"] . $filelocation;

		unlink($filelocation);

		$stmt = $conn->prepare("DELETE FROM file WHERE file_id=$fileIdOld");
		$stmt->execute();
		
		include '../upload.php';
	}
	//fix the stuff for files as soon as that works!
	$newsarticle_id = $_POST["newsarticle_id"];
	$news_title = htmlspecialchars($_POST["news-title"], ENT_QUOTES);
	$categoryId = $_POST["news-category"];
	$fileId = $lastInsertedFileId[0];
	$displayFrom = $_POST["news-date-from"];
	$displayTill = $_POST["news-date-till"];
	if (isset($_POST["news-priority"])) {
		$priority = 1;
	} else {
		$priority = 0;
	}
	$description = htmlspecialchars($_POST["news-description"], ENT_QUOTES); 
	$locations = $_POST["locations"];
	
	if (isset($fileId)){
		echo EditNews($newsarticle_id, $news_title, $categoryId, $displayFrom, $displayTill, $priority, $description, $locations, $fileId); //Calling a function to edit it, which gives back a message if it's successful or not
	} else {
		echo EditNews($newsarticle_id, $news_title, $categoryId, $displayFrom, $displayTill, $priority, $description, $locations); //Calling a function to edit it, which gives back a message if it's successful or not
	}
	return;
} elseif(isset($_GET["newsarticle_id"]) && $method == "remove") { //If only a newsarticle_id is given we'll remove it
	$newsarticle_id = $_GET["newsarticle_id"];

	echo RemoveNews($newsarticle_id); //Calling a function to remove it, which gives back a message if it's successful or not
} else {
	echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div>";
}
$_FILES["file"]["name"] = "";
?>