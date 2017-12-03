<?php
if (isset($_POST["submit"])) {
	$stmt = $conn->prepare("SELECT * FROM location");
	$stmt->execute();
	$locations = $stmt->fetchAll();
	
	$news_title = $_POST["title"];
	$categoryId = $_POST["category"];
	$fileId = $lastInsertedFileId[0];
	$displayFrom = $_POST["dateFrom"];
	$displayTill = $_POST["dateTill"];
	if (isset($_POST["priority"])) {
		$priority = 1;
	} else {
		$priority = 0;
	}
	$description = $_POST["description"]; //should be null when video is being uploaded
	
	
	// inserting newsarticle into db
	$stmt = $conn->prepare("INSERT INTO news_article (title, category_id, file_id, display_from, display_till, priority, description) 
	VALUES ('".$news_title."','".$categoryId."','".$fileId."','".$displayFrom."','".$displayTill."','".$priority."','".$description."')");
	$stmt->execute();
	$lastInsertedNewsId = $conn->lastInsertId();
	
	// inserting relations between newsarticle and locations to display
	foreach ($_POST["location"] as $v) {
		$stmt = $conn->prepare("INSERT INTO news_article_has_location (news_article_id, location_id) 
		VALUES ('".$lastInsertedNewsId."','".$v."')");
		$stmt->execute();
		$finished = $conn->lastInsertId();
	}
	// making sure everything worked out correctly
	if (isset($finished)){
		$success = 1;
	}
}
?>