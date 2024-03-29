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
		echo "			<div class=\"col-md-12 text-news\">";
		if($type == "photo") { 
			echo "			<div class=\"img-news\"><img src=\"$location\" class=\"img-thumbnail news-image\" alt=\"$title\"></div>";
		} elseif($type == "video") {
			$videotype = explode(".", $location);
			echo "			<video class=\"embed-responsive embed-responsive-16by9\" muted controls><source src=\"$location\" type=\"video/". $videotype[1] ."\" class=\"embed-responsive-item embed-responsive-item-16by9\">Your browser does not support video</video>";
		}
		echo "				<p>$description</p>";
		echo "			</div>";
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
			echo ">".substr($title, 0, 60)."...</button></td>";
			echo "	<td>".substr($description, 0, 200)."...</td>";


			if(CheckIfUserHasRight($_SESSION["admin"], "Verwijderen nieuwsbericht", $_SESSION["user_id"])){
				echo "	<td><button type=\"button\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#modal-remove-news\" data-id=\"$news_article_id\" data-title=\"$title\">Verwijderen</td>";
			} else {
				echo "	<td></td>";
			}

			echo "</tr>";
			
			$news_article_id = $row["news_article_id"];
			$title = $row["title"];
			$category_id = $row["category_id"];
			$date = $row["date"];
			$display_from = substr($row["display_from"], 0, -9);
			$display_till = substr($row["display_till"], 0, -9);
			$priority = $row["priority"];
			$description = $row["description"];
			$location = $row["location_id"];
			//File
			$file_location = $row["location"];
			$type = $row["type"];
			$file_id = $row["file_id"];
			
			echo "<tr>";
			echo "	<td><button type=\"button\" class=\"btn btn-link\" data-toggle=\"modal\" data-target=\"#editNews\" ";
			echo "data-id=\"$news_article_id\" data-title=\"$title\" data-description=\"$description\" data-category-id=\"$category_id\" data-file-id=\"$file_id\" data-file-location=\"$file_location\" data-file-type=\"$type\" ";
			echo "data-priority=\"$priority\" data-display-from=\"$display_from\" data-display-till=\"$display_till\" ";

		} elseif ($news_article_id != $row["news_article_id"]) {
			$news_article_id = $row["news_article_id"];
			$title = $row["title"];
			$category_id = $row["category_id"];
			$date = $row["date"];
			$display_from = substr($row["display_from"], 0, -9);
			$display_till = substr($row["display_till"], 0, -9);
			$priority = $row["priority"];
			$description = $row["description"];
			$location = $row["location_id"];
			//File
			$file_location = $row["location"];
			$type = $row["type"];
			$file_id = $row["file_id"];
			
			echo "<tr>";
			echo "	<td><button type=\"button\" class=\"btn btn-link\" data-toggle=\"modal\" data-target=\"#editNews\" ";
			echo "data-id=\"$news_article_id\" data-title=\"$title\" data-description=\"$description\" data-category-id=\"$category_id\" data-file-id=\"$file_id\" data-file-location=\"$file_location\" data-file-type=\"$type\" ";
			echo "data-priority=\"$priority\" data-display-from=\"$display_from\" data-display-till=\"$display_till\" ";
		} else {
			$location .= "," . $row["location_id"];
		}
	}
	if(!$hasAtLeastOneArticle){
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er zijn geen nieuwsartikelen om weer te geven</div>";
	} else {
		echo "data-location=\"$location\"";

		echo ">".substr($title, 0, 60)."...</button></td>";
		echo "	<td>".substr($description, 0, 200)."...</td>";
		
		if(CheckIfUserHasRight($_SESSION["admin"], "Verwijderen nieuwsbericht", $_SESSION["user_id"])){
			echo "	<td><button type=\"button\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#modal-remove-news\" data-id=\"$news_article_id\" data-title=\"$title\">Verwijderen</td>";
		} else {
			echo "	<td></td>";
		}
	}

	echo "</tr>";

	
} else {
	echo "<div class=\"alert alert-danger\" role=\"alert\">Er is geen locatie meegenomen</div>";
}

?>