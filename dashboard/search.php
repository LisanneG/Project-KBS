<?php
session_start();
include 'include/searchFunctions.php';
if(!isset($_SESSION["email"])){
	header("Location: login.php"); //Redirecting to login.php
	exit();
}
if (isset($_POST["logout"])) {
	session_destroy(); //Removing the login session
	header("Location: login.php"); //Redirecting to login.php
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard</title>
	<?php include 'include/css.php'; ?>
</head>
<body>
	<?php include 'include/navbar.php'; ?>
	<section id="dashboard-content" class="container-fluid">
		<?php
			if (isset($_POST["search-words"]) && isset($_POST["search-section"])) {
				echo "<p>Zoekwoord(en): " . $_POST["search-words"] . "</p>";

				$search_words = "";

				foreach (explode(" ", $_POST["search-words"]) as $word) {
					$search_words .= "*$word* ";
				}

				$search_words = rtrim($search_words," ");
				$search_section = $_POST["search-section"];

				//Switch case to see what to search for
				switch ($search_section) {
					case "":
						SearchNewsArticle($search_words);
						SearchLocation($search_words);
						SearchAccount($search_words);
						SearchTheme($search_words);
						SearchRight($search_words);
						SearchCategory($search_words);
						break;
					case "news_article":
						print_r(SearchNewsArticle($search_words));
						break;
					case "location":
						SearchLocation($search_words);
						break;
					case "account":
						SearchAccount($search_words);
						break;
					case "theme":
						SearchTheme($search_words);
						break;
					case "right":
						SearchRight($search_words);
						break;
					case "category":
						SearchCategory($search_words);
						break;
				}
			} else {
				echo "<div class=\"alert alert-warning\" role=\"alert\">Er wordt momenteel op niks gezocht, vul eerst een woord in voordat je zoekt</div>";
			}
		?>	
	</section>

	<?php include 'include/footer.php'; ?>
</body>
</html>