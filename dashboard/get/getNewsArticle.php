<?php

if (isset($_GET["location_id"])) {
	include '../include/framework.php';

	$location_id = $_GET["location_id"];

	$hasAtLeastOneArticle = false;

	foreach (GetNewsArticles($location_id) as $row) {
		$hasAtLeastOneArticle = true;

		$news_article_id = $row["news_article_id"];
		$title = $row["title"];
		$category_id = $row["category_id"];
		$file_id = $row["file_id"];
		$date = $row["date"];
		$display_from = $row["display_from"];
		$display_till = $row["display_till"];
		$priority = $row["priority"];
		$description = $row["description"];
		//File
		$location = $row["location"];
		$type = $row["type"];
		//Category
		$category_name = $row["category_name"];
		$color = $row["background_color"];

		echo "<div class=\"row\">";
		echo "	<div class=\"col-md-12 news-section\">";
		echo "		<p class=\"title\">$title</p>";
		echo "		<div class=\"row\">";
		echo "			<div class=\"col-md-12 text-right\">";
		echo "				<i class=\"fa fa-ellipsis-h\" aria-hidden=\"true\"></i>";
		echo "			</div>";
		echo "			<div class=\"col-md-12\">";
		echo "				<div class=\"img-news\"><img src=\"$location\" class=\"img-thumbnail news-image\" alt=\"$title\"></div>";
		echo "				<p>$description</p>";
		echo "			</div>";
		// if($type == "foto"){
		// 	echo "			<div class=\"col-md-6 text-right\">";
		// 	echo "				<img src=\"$location\" class=\"img-thumbnail news-image\" alt=\"$title\">";
		// 	echo "			</div>";
		// }
		echo "		</div>";
		echo "	</div>";
		echo "</div>";
	}

	if(!$hasAtLeastOneArticle){
		echo "<div class=\"alert alert-warning\" role=\"alert\">De gekozen locatie heeft geen nieuwsberichten</div>";
	}
} elseif (isset($_GET["newsManage"])) {
	session_start();
	include '../include/framework.php';
	$hasAtLeastOneArticle = false;
	$news_article_id = false;
	foreach (GetNewsArticles() as $row) {
		$hasAtLeastOneArticle = true;
		if ($news_article_id != $row["news_article_id"] && $news_article_id != false){
			echo "data-location=\"$location\"";
			echo ">$title</button></td>";
			echo "	<td>$description</td>";

			if(CheckIfUserHasRight($_SESSION["admin"], "Verwijderen nieuwsbericht", $_SESSION["user_id"])){
				echo "	<td><button type=\"button\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#modal-remove-news\" data-id=\"$news_article_id\" data-title=\"$title\">Verwijderen</td>";
			} else {
				echo "	<td></td>";
			}
			
			echo "</tr>";
			
			$news_article_id = $row["news_article_id"];
			$title = $row["title"];
			$category_id = $row["category_id"];
			$file_id = $row["file_id"];
			$date = $row["date"];
			$display_from = $row["display_from"];
			$display_from = substr($display_from, 0, -9);
			$display_till = $row["display_till"];
			$display_till = substr($display_till, 0, -9);
			$priority = $row["priority"];
			$description = $row["description"];
			//File
			$file_location = $row["location"];
			$location = $row["location_id"];
			echo "<tr>";
			echo "	<td><button type=\"button\" class=\"btn btn-link\" data-toggle=\"modal\" data-target=\"#editNews\" ";
			echo "data-id=\"$news_article_id\" data-title=\"$title\" data-description=\"$description\" data-category-id=\"$category_id\" data-file-location=\"$file_location\" ";
			echo "data-priority=\"$priority\" data-display-from=\"$display_from\" data-display-till=\"$display_till\" ";

		} elseif ($news_article_id != $row["news_article_id"]) {
			$news_article_id = $row["news_article_id"];
			$title = $row["title"];
			$category_id = $row["category_id"];
			$file_id = $row["file_id"];
			$date = $row["date"];
			$display_from = $row["display_from"];
			$display_from = substr($display_from, 0, -9);
			$display_till = $row["display_till"];
			$display_till = substr($display_till, 0, -9);
			$priority = $row["priority"];
			$description = $row["description"];
			//File
			$file_location = $row["location"];
			$location = $row["location_id"];
			echo "<tr>";
			echo "	<td><button type=\"button\" class=\"btn btn-link\" data-toggle=\"modal\" data-target=\"#editNews\" ";
			echo "data-id=\"$news_article_id\" data-title=\"$title\" data-description=\"$description\" data-category-id=\"$category_id\" data-file-location=\"$file_location\" ";
			echo "data-priority=\"$priority\" data-display-from=\"$display_from\" data-display-till=\"$display_till\" ";
		} else {
			$location .= "," . $row["location_id"];
		}
	}
	echo "data-location=\"$location\"";
	echo ">$title</button></td>";
	echo "	<td>$description</td>";

	if(CheckIfUserHasRight($_SESSION["admin"], "Verwijderen nieuwsbericht", $_SESSION["user_id"])){
		echo "	<td><button type=\"button\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#modal-remove-news\" data-id=\"$news_article_id\" data-title=\"$title\">Verwijderen</td>";
	} else {
		echo "	<td></td>";
	}
	
	echo "</tr>";

	if(!$hasAtLeastOneArticle){
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er zijn geen nieuwsartikelen om weer te geven</div>";
	}
} else {
	echo "<div class=\"alert alert-danger\" role=\"alert\">Er is geen locatie meegenomen</div>";
}

?>