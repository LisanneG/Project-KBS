<?php 
	include '../database.php';
	
	$stmt = $conn->prepare("SELECT * FROM location");
	$stmt->execute();
	$locations = $stmt->fetchAll();
	
	$stmt = $conn->prepare("SELECT * FROM category");
	$stmt->execute();
	$categories = $stmt->fetchAll();
	
	print("</br>Weergeven op locatie:</br>");
	foreach ($locations as $location) {
		print("<input type='checkbox' value=".$location["location_id"]." name=".$location["name"].">".$location["name"]."</br>");
	}
	
	print("</br>Categorie:</br>");
	foreach ($categories as $category) {
		print("<input type='radio' value=".$category["category_id"]." name='category' selected>".$category["name"]."</br>");
	}
	
	var_dump($_POST["name"]);
	$checkLocation = array();
	foreach ($locations as $location) {
		$locationName = $location["name"];
		//var_dump($_POST[$locationName]);
		if (isset($_POST[$locationName])) {
			$checkLocation[$_POST[$locationName]] = $locationName;
			var_dump($_POST[$locationName]);
		}
	}
	
	foreach ($checkLocation as $printLocation) {
		print($printLocation."</br>");
	}
	
	
?>
