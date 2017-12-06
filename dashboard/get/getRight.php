<?php

if (isset($_GET["user_id"])) {
	include '../framework.php';

	$user_id = $_GET["user_id"];

	$hasAtLeastOneRight = false;

	foreach (GetUserRights($user_id) as $row) {
		$hasAtLeastOneRight = true;

		$right_id = $row["right_id"];
		$name = $row["name"];
		$description = $row["description"];
		$has_this_right = ($row["has_this_right"] == 1) ? "checked" : "";		

		echo "<tr>";
		echo "	<td><input type=\"checkbox\" name=\"rights[]\" value=\"$right_id\" $has_this_right></td>";
		echo "	<td>$name</td>";
		echo "	<td>$description</td>";
		echo "</tr>";
	}

	if(!$hasAtLeastOneRight){
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er zijn geen rechten om te geven</div>";
	}
} else {
	include '../framework.php';

	$hasAtLeastOneRight = false;

	foreach (GetRights() as $row) {
		$hasAtLeastOneRight = true;

		$right_id = $row["right_id"];
		$name = $row["name"];
		$description = $row["description"];	

		echo "<tr>";
		echo "	<td><button type=\"button\" class=\"btn btn-link\" data-toggle=\"modal\" data-target=\"#editRight\" data-id=\"$right_id\" data-name=\"$name\" data-description=\"$description\">$name</button></td>";
		echo "	<td>$description</td>";
		echo "</tr>";
	}

	if(!$hasAtLeastOneRight){
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er zijn geen rechten om te geven</div>";
	}
}

?>