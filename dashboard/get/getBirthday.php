<?php

if (isset($_GET["location_id"])) {
	include '../include/framework.php';

	$location_id = $_GET["location_id"];

	$hasAtLeastOneBirthday = false;

	foreach (GetBirthdays($location_id) as $row) {
		$hasAtLeastOneBirthday = true;

		$birthday_id = $row["birthday_id"];
		$date = $row["date"];
		//User
		$user_id = $row["user_id"];		
		$first_name = $row["first_name"];
		$insertion = $row["insertion"];
		$last_name = $row["last_name"];		
		$birthday = date("d-m-Y", strtotime($row["birthday"]));
		//Category
		$category_id = $row["category_id"];
		$name = $row["name"];
		$background_color = $row["background_color"];
		//File
		$location = $row["location"];
		$type = $row["type"];

		//Creating the fullname
		$full_name = "$first_name ";
		if($insertion != ""){
			$full_name .= "$insertion ";
		}
		$full_name .= "$last_name";

		echo "<div class=\"row\">";
		echo "	<div class=\"col-md-12 birthday-section\">";
		echo "		<p class=\"title\">Verjaardag</p>";
		echo "		<div class=\"row\">";				
		if($location != ""){
			echo "			<div class=\"col-md-2\">";
			echo "				<img src=\"$location\" alt=\"$full_name\" class=\"img-thumbnail birthday-img\">";
			echo "			</div>";
		}
		echo "			<div class=\"col-md-1" . (($location != "") ? "0" : "2") . "\">";
		echo "				<p>$full_name ($birthday)</p>";
		echo "			</div>";
		echo "		</div>";
		echo "	</div>";
		echo "</div>";
	}

	if(!$hasAtLeastOneBirthday){
		echo "<div class=\"alert alert-warning\" role=\"alert\">De gekozen locatie heeft geen verjaardagen binnen de 3 dagen</div>";
	}
} else {
	echo "<div class=\"alert alert-danger\" role=\"alert\">Er is geen locatie meegenomen</div>";
}

?>