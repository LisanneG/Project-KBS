<?php
if (isset($_POST["submit"])) {
	$news_title = $_POST["title"];
	$categoryId = $_POST["news-category"];
	
	$fileId = $lastInsertedFileId[0];
	
	$displayFrom = $_POST["date-from"];
	$displayTill = $_POST["date-till"];
	if (isset($_POST["priority"])) {
		$priority = 1;
	} else {
		$priority = 0;
	}
	$description = $_POST["description"]; //should be null when video is being uploaded
	
	//checking if a file has been added and choosing the right query for the job
	if (isset($fileId)) {
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
//Alerts for success & failure
/*if (isset($_POST["submit"])) {
	if ($success == 1) {
		print("<div class=\"alert alert-success\"role=\"alert\">Nieuwsbericht succesvol toegevoegd</div>");
	} elseif ($success == 0) {
		print("<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan, het nieuwsbericht is niet toegevoegd</div>");
	}
}*/
?>