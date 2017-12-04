<?php

if (isset($_GET["location_id"])) {
	include '../framework.php';

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
		$birthday = $row["birthday"];		
		//Category
		$category_id = $row["category_id"];
		$name = $row["name"];
		$color = $row["color"];
		//File
		$location = $row["location"];
		$type = $row["type"];
		//File
		$file_id = $row["file_id"];
		$location = $row["location"];
		$type = $row["type"];

		//Creating the fullname
		$full_name = "$first_name ";
		if($insertion != ""){
			$full_name .= "$insertion ";
		}
		$full_name .= "$last_name";

		//Creating the right date
		$date_birthday = date("d-m", strtotime($birthday));
		$date_now = date("d-m", time());
		$date_with_days = date('d-m', strtotime($date. ' + 3 days'));
			
		echo "<div class=\"row\">";
		echo "	<div class=\"col-md-12 birthday-section\">";
		echo "		<p class=\"title\">Verjaardag</p>";
		echo "		<div class=\"row\">";		
		echo "			<div class=\"col-md-12\">";
		echo "				<p>$full_name ($date_birthday)</p>";
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