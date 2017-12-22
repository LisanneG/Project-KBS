<?php
if (isset($_POST["submit"])) {
	$news_title = htmlspecialchars($_POST["title"], ENT_QUOTES);
	$categoryId = $_POST["news-category"];

	
	
	$displayFrom = $_POST["date-from"];
	$displayTill = $_POST["date-till"];
	if (isset($_POST["priority"])) {
		$priority = 1;
	} else {
		$priority = 0;
	}
	$description = htmlspecialchars($_POST["description"], ENT_QUOTES); 
	
	//checking if a file has been added and choosing the right query for the job
	if (isset($lastInsertedFileId)) {
		$fileId = $lastInsertedFileId[0];
		// inserting newsarticle w/ file into db
		$stmt = $conn->prepare("INSERT INTO news_article (title, category_id, file_id, display_from, display_till, priority, description) VALUES (?,?,?,?,?,?,?)");
		$stmt->execute(array($news_title, $categoryId, $fileId, $displayFrom, $displayTill, $priority, $description));
		$lastInsertedNewsId = $conn->lastInsertId();
	} else {
		// inserting newsarticle w/out file into db
		$stmt = $conn->prepare("INSERT INTO news_article (title, category_id, display_from, display_till, priority, description) VALUES (?,?,?,?,?,?)");
		if ($stmt->execute(array($news_title, $categoryId, $displayFrom, $displayTill, $priority, $description))) {
			print("<div class=\"alert alert-success\"role=\"alert\">Nieuwsbericht succesvol toegevoegd</div>");
		}
		$lastInsertedNewsId = $conn->lastInsertId();
	}
	
	// inserting relations between newsarticle and locations to display
	foreach ($_POST["location"] as $v) {
		$stmt = $conn->prepare("INSERT INTO news_article_has_location (news_article_id, location_id) VALUES (?,?)");
		$stmt->execute(array($lastInsertedNewsId, $v));
		
	
	

	}
}
?>