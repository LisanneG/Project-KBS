<?php
if (isset($_POST["submit"])) {
	$stmt = $conn->prepare("SELECT * FROM location");
	$stmt->execute();
	$locations = $stmt->fetchAll();
	
	$checkLocation = array();
	foreach ($locations as $location) {
		$locationId = $location["location_id"];
		//var_dump($_POST[$locationName]);
		if (isset($_POST[$locationId])) {
				//$checkLocation = $checkLocation.$_POST[$locationName];
				var_dump($_POST[$locationId]);
		}
	}
	
	foreach ($checkLocation as $printLocation) {
		print($printLocation);
	}
	
	$stmt = $conn->prepare("INSERT INTO news_article (title, category_id, file_id, location_id, display_from, display_till, priority, description) 
	VALUES (?,?,?,?,?,?,?,?)");
	$stmt->execute(array());
	
	
}
?>