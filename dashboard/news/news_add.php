<?php 
	include '../database.php';
	
	// collecting all locations in db
	$stmt = $conn->prepare("SELECT * FROM location");
	$stmt->execute();
	$locations = $stmt->fetchAll();
	//collecting all categories in db
	$stmt = $conn->prepare("SELECT * FROM category");
	$stmt->execute();
	$categories = $stmt->fetchAll();
	
	//printing locations as checkboxes
	print("<div class=\"form-group row\"><div class=\"col-2 col-form-label\">Locatie(s):</div>");
	foreach ($locations as $location) {
		//print("<label class=\"control-label col-form-label mr-4 locations\"><input class=\"mr-1\" type=\"checkbox\" value=".$location["location_id"]." id=\"news-location\" name=\"location[]\" >".$location["name"]."</label>");
		echo "	<span class=\"control-label col-form-label mr-4\">";
		echo "		<label class=\"control-label col-form-label mr-4\"><input class=\"mr-1\" type=\"checkbox\" value=".$location["location_id"]." id=\"news-location\" name=\"location[]\" >".$location["name"]."</label>";
		echo "	</span>";
	}
	print("</div>");
	//printing categories as radiobuttons
	print("<div class=\"form-group row\"><div class=\"col-2 col-form-label\">Categorie:</div>");
	foreach ($categories as $category) {
		print("<label class=\"control-label col-form-label mr-4 categories\"><input class=\"mr-1\" type=\"radio\" value=".$category["category_id"]." id=\"news-category\" name=\"news-category\" required>".$category["name"]."</label>");
	}
	print("</div>");
?>
