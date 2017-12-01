<?php

if (isset($_GET["location_id"])) {
	include '../framework.php';

	$location_id = $_GET["location_id"];

	$hasAtLeastOneArticle = false;

	foreach (GetNewsArticles($location_id) as $row) {
		$hasAtLeastOneArticle = true;

		$news_article_id = $row["news_article_id"];
		$title = $row["title"];
		$category_id = $row["category_id"];
		$file_id = $row["file_id"];
		$date = $row["date"];
		$location_id = $row["location_id"];
		$display_from = $row["display_from"];
		$display_till = $row["display_till"];
		$priority = $row["priority"];
		$description = $row["description"];
		//File
		$location = $row["location"];
		$type = $row["type"];
		//Category
		$category_name = $row["category_name"];
		$color = $row["color"];
		//location
		$location_name = $row["location_name"];
		$address = $row["address"];
		$postal_code = $row["postal_code"];
		$main_number = $row["main_number"];
		$intern_number = $row["intern_number"];	

		echo "<div class=\"row\">";
		echo "	<div class=\"col-md-12 news-section\">";
		echo "		<p class=\"title\">$title</p>";
		echo "		<div class=\"row\">";
		echo "			<div class=\"col-md-12 text-right\">";
		echo "				<img src=\"../img/icons/dots.png\">";
		echo "			</div>";
		echo "			<div class=\"col-md-6\">";
		echo "				<p>$description</p>";
		echo "			</div>";
		echo "			<div class=\"col-md-6 text-right\">";
		echo "				<img src=\"..$location\" class=\"img-thumbnail news-image\" alt=\"$title\">";
		echo "			</div>";
		echo "		</div>";
		echo "	</div>";
		echo "</div>";
	}

	if(!$hasAtLeastOneArticle){
		echo "<div class=\"alert alert-warning\" role=\"alert\">De gekozen locatie heeft geen nieuwsberichten</div>";
	}
} else {
	echo "<div class=\"alert alert-danger\" role=\"alert\">Er is geen locatie meegenomen</div>";
}

?>