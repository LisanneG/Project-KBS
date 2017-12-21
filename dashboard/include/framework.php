<?php
function GetDatabaseConnection(){
	try{
		// Setting up the info for the database
		$host = "localhost";
		$username = "root";
		$password = "";
		$db = "dotcasting";
		// Trying to get a connection
		return $conn = new PDO("mysql:dbname=$db;host=$host", $username, $password);
	}
	catch(PDOException $ex){
		// If for some reason the connection can't be made, it will give an error and stop with everything else
		die("<div class='alert alert-danger' role='alert'><strong>Error:</strong> kan geen verbinding maken</div>");
	}
}
// Function to check if user is in the db with the correct email and password
// Returns results if there is no result it will give a false
function CheckIfUserExists($input_email, $input_password)
{
	// Preparing query
	$query = GetDatabaseConnection()->prepare("SELECT u.user_id, u.admin FROM `user` u WHERE u.email = ? AND u.password = ? LIMIT 0,1");
	$query->execute(array($input_email, $input_password)); //Putting in the parameters
	$result = $query->fetch(); //Fetching it
	
	if($query->rowCount() > 0){		
		return $result;
	} else {
		return false;
	}
}

// Function to check if the user whos logged in has the right to do something on a certain page
// Returns true or false
function CheckIfUserHasRight($admin, $right_name, $user_id){
	if($admin == 0){
		//Building the query
		$stringBuilder = "SELECT COUNT(uhr.user_id) ";
		$stringBuilder .= "FROM user_has_right uhr ";
		$stringBuilder .= "INNER JOIN `right` r ON r.right_id=uhr.right_id ";
		$stringBuilder .= "WHERE r.name=? AND uhr.user_id=? ";

		// Preparing query
		$query = GetDatabaseConnection()->prepare($stringBuilder);
		$query->execute(array($right_name, $user_id)); //Putting in the parameters
		$result = $query->fetchAll(); //Fetching it

		if($result[0][0] > 0){
			return true;
		} else {
			return false;
		}
	} else {
		return true;
	}
}

// Function to get all the locations
// Returns the results
function GetLocations(){
	// Preparing query
	$query = GetDatabaseConnection()->prepare("SELECT location_id, name FROM location");
	$query->execute();
	$result = $query->fetchAll(); //Fetching it
	return $result;
}
// Function to get all the news articles
// Returns the results
function GetNewsArticles($location_id = NULL){
	if (isset($location_id)){
		//Building the query
		$stringBuilder = "SELECT na.*, f.location, f.`type`, c.name AS category_name, c.background_color ";
		$stringBuilder .= "FROM news_article na ";
		$stringBuilder .= "LEFT JOIN `file` f ON f.file_id=na.file_id ";
		$stringBuilder .= "INNER JOIN category c ON c.category_id=na.category_id ";
		$stringBuilder .= "WHERE (na.display_till >= NOW() && display_from <= NOW()) ";
		$stringBuilder .= "AND na.news_article_id IN (SELECT nahl.news_article_id FROM news_article_has_location nahl WHERE nahl.location_id=?) ";
		// Preparing query
		$query = GetDatabaseConnection()->prepare($stringBuilder);
		$query->execute(array($location_id)); //Putting in the parameters
		$result = $query->fetchAll(); //Fetching it
		return $result;
	} else {
		//Building the query
		$stringBuilder = "SELECT * ";
		$stringBuilder .= "FROM news_article na ";
		$stringBuilder .= "JOIN news_article_has_location nahl ON na.news_article_id = nahl.news_article_id ";
		$stringBuilder .= "JOIN file f ON na.file_id = f.file_id ";
		//$stringBuilder .= "GROUP BY na.news_article_id";
		// Preparing query
		$query = GetDatabaseConnection()->prepare($stringBuilder);
		$query->execute(); //Putting in the parameters
		$result = $query->fetchAll(); //Fetching it
		return $result;
	}
}
// Function to get all the birthdays
// Returns the results
function GetBirthdays($location_id){
	//Building the query
	$stringBuilder = "SELECT b.*, u.first_name, u.insertion, u.last_name, u.birthday, c.name, c.background_color, f.location, f.`type` ";
	$stringBuilder .= "FROM birthday b ";
	$stringBuilder .= "INNER JOIN `user` u ON u.user_id=b.user_id ";
	$stringBuilder .= "LEFT JOIN category c ON c.category_id=b.category_id ";
	$stringBuilder .= "LEFT JOIN `file` f ON f.file_id=u.file_id ";	
	$stringBuilder .= "WHERE u.location=? ";
	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(array($location_id)); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it
	return $result;
}
// Function to get the company logo from the layout
// Returns location from file
function GetLogo(){
	//Building the query
	$stringBuilder = "SELECT f.location ";
	$stringBuilder .= "FROM layout l ";
	$stringBuilder .= "INNER JOIN `file` f ON f.file_id=l.logo ";
	$stringBuilder .= "LIMIT 0,1 ";
	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute();
	$result = $query->fetchAll(); //Fetching it
	$location = "";
	if (isset($result[0]["location"])) {
		$location = $result[0]["location"];
	}
	return "$location";
}
// Function to get all the users
// Returns result
function GetUsers($NotAdmin){
	$stringBuilder = "SELECT u.user_id, u.email, l.name ";
	$stringBuilder .= "FROM `user` u ";
	$stringBuilder .= "INNER JOIN location l ON l.location_id=u.location ";
	if($NotAdmin){
		$stringBuilder .= "WHERE u.admin=0 ";
	}
	$stringBuilder .= "ORDER BY l.name ";
	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it
	return $result;
}
// Function to get all the rights for a specific user
// Returns result
function GetRights(){
	$stringBuilder = "SELECT r.* ";
	$stringBuilder .= "FROM `right` r ";
	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute();
	$result = $query->fetchAll(); //Fetching it
	return $result;
}
// Function to get all the rights for a specific user
// Returns result
function GetUserRights($user_id){
	$stringBuilder = "SELECT r.*, (SELECT COUNT(uhr.right_id) FROM user_has_right uhr WHERE uhr.user_id=? AND uhr.right_id=r.right_id) AS has_this_right ";
	$stringBuilder .= "FROM `right` r ";
	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	$query->execute(array($user_id)); //Putting in the parameters
	$result = $query->fetchAll(); //Fetching it
	return $result;
}
// Function to save all the rights for a specific user
// Returns alert
function SaveUserRights($user_id, $rights){
	//First deleting all the rights
	$stringBuilder = "DELETE FROM user_has_right ";
	$stringBuilder .= "WHERE user_id=? ";
	// Preparing query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	
	$valid = true;
	if($query->execute(array($user_id))){
		//Making the insert query
		$stringBuilder = "INSERT INTO user_has_right (user_id, right_id) VALUES (?,?) ";
		//preparing the query
		$query = GetDatabaseConnection()->prepare($stringBuilder);
		foreach ($rights as $right_id) {
			if($query->execute(array($user_id, $right_id))){
				//
			} else {
				$valid = false;
			}
		}
	} else {
		$valid = false;
	}
	if($valid){
		echo "<div class=\"alert alert-success\" role=\"alert\">De rechten zijn opgeslagen</div>";
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fouts gegaan</div>";
	}
}
//Function for inserting a new file
function SaveFile($input_name, $input_description){
	//Making the insert query
	$stringBuilder = "INSERT INTO `right` (name, description) VALUES (?,?) ";
	//preparing the query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	if($query->execute(array($input_name, $input_description))){
		echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Het recht is opgeslagen</div>";
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div>";
	}
}
//Function for updating association between file and newsarticle
function EditFile($newsarticle_id, $input_title, $input_description){
	//Making the insert query
	$stringBuilder = "UPDATE `right` ";
	$stringBuilder .= "SET name=?, description=? ";
	$stringBuilder .= "WHERE right_id=? ";
	
	//preparing the query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	if($query->execute(array($input_title, $input_description, $newsarticle_id))){
		echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Het nieuwbericht is bijgewerkt</div>";
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div>";
	}
}
//Function for inserting a new newsarticle
function SaveNews($input_name, $input_description){
	//Making the insert query
	$stringBuilder = "INSERT INTO `right` (name, description) VALUES (?,?) ";
	//preparing the query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	if($query->execute(array($input_name, $input_description))){
		echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Het recht is opgeslagen</div>";
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div>";
	}
}
//Function for inserting an edited newsarticle
function EditNews($newsarticle_id, $news_title, $categoryId, $displayFrom, $displayTill, $priority, $description){
	//Making the update query											//add fileId as soon as fileuploading works
	$stringBuilder = "UPDATE news_article ";
	$stringBuilder .= "SET title='$news_title', ";
	$stringBuilder .= "description='$description', ";
	$stringBuilder .= "priority='$priority', ";
	//$stringBuilder .= "file_id=?, "; 					//verander dit as soon as fileId shit works
	$stringBuilder .= "display_from='$displayFrom', ";
	$stringBuilder .= "display_till='$displayTill', ";
	$stringBuilder .= "category_id='$categoryId' ";
	$stringBuilder .= "WHERE news_article_id='$newsarticle_id' ";
	print($stringBuilder);
	print($news_title.$description.$priority.$displayFrom.$displayTill.$categoryId.$newsarticle_id);
	//preparing the query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	if($query->execute()){
		echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Het nieuwsbericht is bijgewerkt</div>";
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div>";
	}
}
//Function for deleting a selected newsarticle
function RemoveNews($newsarticle_id){
	//Making the delete query
	$stringBuilder = "DELETE FROM `news_article` WHERE news_article_id=? ";
	//preparing the query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	if($query->execute(array($newsarticle_id))){
		echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Het nieuwsbericht is verwijderd</div>";
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div>";
	}
}
function SaveRights($input_name, $input_description){
	//Making the insert query
	$stringBuilder = "INSERT INTO `right` (name, description) VALUES (?,?) ";
	//preparing the query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	if($query->execute(array($input_name, $input_description))){
		echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Het recht is opgeslagen</div>";
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div>";
	}
}
function EditRights($right_id, $input_name, $input_description){
	//Making the insert query
	$stringBuilder = "UPDATE `right` SET name=?, description=? WHERE right_id=? ";
	//preparing the query
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	if($query->execute(array($input_name, $input_description, $right_id))){
		echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Het recht is bijgewerkt</div>";
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div>";
	}
}
function RemoveRights($right_id){
	//First removing the right whos linked with the right id
	$stringBuilder = "DELETE FROM user_has_right WHERE right_id=? ";
	$query = GetDatabaseConnection()->prepare($stringBuilder);
	
	if($query->execute(array($right_id))){
		//Making the insert query
		$stringBuilder = "DELETE FROM `right` WHERE right_id=? ";
		//preparing the query
		$query = GetDatabaseConnection()->prepare($stringBuilder);
		if($query->execute(array($right_id))){
			echo "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Het recht is verwijderd</div>";
		} else {
			echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div>";
		}
	} else {
		echo "<div class=\"alert alert-danger\" role=\"alert\">Er is iets fout gegaan</div>";
	}
}
/* functions to make narrowcasting page run */
function getLocation(){
	//TODO: work on it
	include 'database.php';
	if(!(isset($_GET["location"]))){
		print("<div class='alert alert-danger' role='alert'><strong>Error:</strong> Geen locatie ingesteld.</div>");
		
		if(isset($_SESSION["location_name"]) && (isset($_SESSION["location_id"]))){
			$_GET["location"] = $_SESSION["location_name"];
			if($_SERVER["REQUEST_URI"] == '/index.php'){
			header("location:index.php?location=" . $_SESSION["location_name"]);
			}
			return $_SESSION["location_id"];
		}
		return NULL;
	}
	
	
	else{
		$locationquery = $conn->prepare("SELECT location_id, `name` FROM `location` WHERE `name` = ? ");
		$locationquery->execute(array($_GET["location"]));
		$locationresult = $locationquery->fetch();
		if($locationquery->rowCount() > 0){
			$_SESSION["location_id"] = $locationresult["location_id"];
			$_SESSION["location_name"] = $locationresult["name"];
			return $locationresult["location_id"];
		}
		else{
			print("<div class='alert alert-danger' role='alert'><strong>Error:</strong> Geen geldige locatie.</div>");
			return NULL;
		}
	}
}
function getTheme($location_id){
	include 'database.php';
	if($location_id == NULL){
		return;
	}
	
	
	//TODO: make query, add relevant info to style
	$themequery = $conn->prepare("SELECT lay.font as 'font', lay.font_color as 'font-color', flayoutlogo.location as 'logo', flayoutbg.location as 'background-layout', ftheme.location as 'background-theme', lay.background_color as 'background-color-navbar', loc.theme_id as 'isTheme' FROM `location` loc
	
	LEFT JOIN theme th ON loc.theme_id = th.theme_id
	LEFT JOIN layout lay ON loc.layout_id = lay.layout_id
	LEFT JOIN `file` ftheme ON th.background_file = ftheme.file_id
	LEFT JOIN `file` flayoutlogo ON lay.logo = flayoutlogo.file_id
	LEFT JOIN `file` flayoutbg ON lay.default_background = flayoutbg.file_id
	WHERE loc.location_id = ? ");
	$themequery->execute(array($location_id));
	$themeresult = $themequery->fetch(PDO::FETCH_ASSOC);
	if(($themequery->rowCount() > 0) && ($themequery->rowCount() < 2)){
		print("<style>");
		if($themeresult["isTheme"] == NULL){
		print("body {background-image: 'url(". $themeresult["background-layout"] .")'; font-family: ". $themeresult["font"] .";}");
		}
		
		else {
			print("body {background-image: 'url(". $themeresult["background-theme"] .")'; font-family: ". $themeresult["font"] .";}");
		}
		
		
		
		print(" nav#top-bar {background-color: ". $themeresult["background-color-navbar"] ." ; color: ". $themeresult["font-color"] ." ;}");
		print("</style>");
		$logo = $themeresult["logo"];
				//li bgcolor needed?
				return $logo;
	}
	else{
		return;
	}
}
function getPriority($location_id){
	include 'database.php';
	$priorityquery = $conn->prepare("SELECT n.news_article_id, title, background_color, `date`, `description` FROM news_article n 
	LEFT JOIN category c ON n.category_id = c.category_id 
	LEFT JOIN news_article_has_location nahl ON n.news_article_id = nahl.news_article_id 
	WHERE (display_from <= NOW() AND display_till >= NOW())
	AND nahl.location_id = ? AND `priority` = ?"); 
	$priorityquery->execute(array($location_id, 1));
		foreach($priorityquery as $row){
			
			print("<li class='media mb-5 mt-5 border border-dark priority-message' style='background-color: ". $row['background_color']."' id='" . $row['news_article_id'] ."-prioritymessage'>
			<div class='media-body mx-4 mt-4'>
			<h3 class='mb-4 font-weight-bold'> " . $row['title'] . "</h3>
			<div class'messagecontent01'>" . $row['description']. "</div>
			<p class='mt-2'>Datum: ". date( "d-m-Y", strtotime($row['date'])) ."</p>
			<div class='d-flex justify-content-end align-self-end mt-5'><i class='fa fa-exclamation-triangle fa-4x priority-alert float-right' aria-hidden='true' ></i></div>			
			</div>
			");
			print("</li>");
		}
	
}


function checkBirthday($days){
	if($days == 0){
		return " is jarig!";
	}
	elseif($days < 0){
		return " werd jarig!";
	}
	elseif($days > 0){
		return " wordt jarig!";
	}
}





function readDB($location_id)
{
	
	include 'database.php';            
	$mainquery = $conn->prepare("SELECT n.news_article_id, title, background_color, n.file_id as 'fileID', `date`, `description`, nahl.location_id , `type`, `priority`, f.muted, `location` FROM news_article n 
	LEFT JOIN `file` f ON n.file_id = f.file_id 
	LEFT JOIN category c ON n.category_id = c.category_id 
	LEFT JOIN news_article_has_location nahl ON n.news_article_id = nahl.news_article_id 
	WHERE (display_from <= NOW() AND display_till >= NOW()) 
	AND nahl.location_id = ? 
	AND `priority` = ?");
	$mainquery->execute(array($location_id, 0));
	
	if(!($mainquery->rowCount() > 0)){
		print("<div class='alert alert-info' role='alert'><strong>Error:</strong> Geen berichten.</div>");
		return false;
	} 
	else {
		
	}
	foreach($mainquery as $row) {
		
		if($row['type'] == "photo" || $row["type"] == "pdf"){
			//nieuwbericht gewoon
			
			print("<li class='media mb-5 mt-5 border border-dark' style='background-color: ". $row['background_color']."' id='" . $row['news_article_id']."-messageimg'>
			<div class='media-body mx-4 mt-4'>
			<h3 class='font-weight-bold mb-4'> " . $row['title'] . "</h3>
			<div class='messagecontent01'>" . $row['description']. "</div>
			<p class='mt-2'>Datum: ". date( "d-m-Y", strtotime($row['date'])) ."</p>
			</div>
			<div class='media-object d-flex align-self-center mr-4 flex-column col-5 mt-4 mb-4' '>
			<img class='align-self-center img-thumbnail img-responsive' src='". $row['location'] ."' alt='Error'>");
			print("</div>");                                   
			print("</li>");
			
		}
		elseif($row['fileID'] == NULL){
		
			print("<li class='media mb-5 mt-5 border border-dark' style='background-color: ". $row['background_color']."' id='" . $row['news_article_id'] ."-message'>
			<div class='media-body mx-4 mt-4'>
			<h3 class='mb-4 font-weight-bold'> " . $row['title'] . "</h3>
			<div class'messagecontent01'>" . $row['description']. "</div>
			<p class='mt-2'>Datum: ". date( "d-m-Y", strtotime($row['date'])) ."</p>
			</div>
			<div class='media-object d-flex align-self-center mr-4 flex-column col-5 mt-4 mb-4' '>
			");
			print("</div>");
			print("</li>");
		}
		elseif($row['type'] == "video" && $row["muted"] == 1){
			$videotype = explode(".", $row['location']);
			print("<li class='media mb-5 mt-5 border border-dark' style='background-color: ". $row['background_color']."' id='" .$row['news_article_id'] ."-messagevideo'>
			<div class='media-body mx-4 mt-4'>
			<h3 class='font-weight-bold mb-4'>". $row['title'] ."</h3>
			<video class='embed-responsive embed-responsive-16by9' muted>
			<source src='". $row['location'] ."' type='video/". $videotype[1] ."' class='embed-responsive-item embed-responsive-item-16by9'>Your browser does not support video</video>
			<p class='mt-2'>Datum: ". date( "d-m-Y", strtotime($row['date'])) ."</p>
			</div>");
			print("</li>");
		}
		elseif($row['type'] == "video" && $row["muted"] == NULL){
			$videotype = explode(".", $row['location']);
			print("<li class='media mb-5 mt-5 border border-dark' style='background-color: ". $row['background_color']."' id='" .$row['news_article_id'] . "-messagevideowithsound'>
			<div class='media-body mx-4 mt-4'>
			<h3 class='font-weight-bold mb-4'>". $row['title'] ."</h3>
			<video class='embed-responsive embed-responsive-16by9'>
			<source src='". $row['location'] ."' type='video/". $videotype[1] ."' class='embed-responsive-item embed-responsive-item-16by9'>Your browser does not support video</video>
			<p class='mt-2'>Datum: ". date( "d-m-Y", strtotime($row['date'])) ."</p>
			</div>");
			print("</li>");
		}
		
	}
	$birthdayquery = $conn->prepare("SELECT (DAY(NOW()) - DAY(b.date)) as days_x_birthday , birthday_id, f.location as photolocation, u.file_id as photoid,  c.background_color as bgcolor, first_name FROM birthday b 
	LEFT JOIN user u ON b.user_id = u.user_id 
	LEFT JOIN category c ON b.category_id = c.category_id
    LEFT JOIN file f ON u.file_id = f.file_id
	WHERE (b.date BETWEEN DATE_SUB(NOW(), INTERVAL 3 DAY) AND DATE_ADD(NOW(), INTERVAL 3 DAY))  AND u.location = ?
	ORDER BY first_name"); 
	$birthdayquery->execute(array($location_id));
	// getting birthday information
	
	foreach($birthdayquery as $bdrow){
		//hou hier geen rekening met catagorie, ik ga er van uit dat dat er sowieso anders uit ziet.
		if($bdrow["photoid"] == NULL){
			//verjaardag zonder foto
			print("<li class='media mb-5 mt-5 border border-dark' style='background-color: ". $bdrow["bgcolor"]."' id='" . $bdrow['birthday_id']. "-birthdaynoimg'>
			<div class='media-body'>
			<h3 class='mx-5 my-5'> " . $bdrow['first_name'] . checkBirthday($bdrow["days_x_birthday"]) ."</h3>
			</div>
			</li>");
		}
		else{
			//verjaardag met foto
			print("<li class='media mb-5 mt-5 border border-dark' style='background-color: ". $bdrow['color']."' id='" . $bdrow['birthday_id']. "-birthdayimg'>
			<div class='media-body'>
			<h3 class='mx-5 my-5'> " . $bdrow['first_name'] . checkBirthday($bdrow["days_x_birthday"]) ."</h3>
			</div>
			<div class='media-object d-flex align-self-center mr-4 flex-column col-5 mt-4 mb-4' '>                        
			<img class='align-self-center img-thumbnail img-responsive' src='". $bdrow['photolocation'] ."' alt='Error'>                                    
			</div>
			</li>");
		}
	}

	

	return $location_id;
} 
/* end of screen functionality*/


function debug_to_console($data){
    $output = $data;
    if (is_array($output)){
        $output = implode(',', $output);
	}
    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

//function for uploading file and storing info in db

function fileUpload(){
	include '../../database.php';
	$imageList = array("png", "jpeg", "jpg", "gif");
	$videoList = array("mp4", "avi");
	$pdfList = array("pdf");
	$counter = 0;
	$lastInsertedFileId = array();
	foreach ($_FILES["medium"]["name"] as $k => $v) {
        $medium = str_replace(" ", "_", $_FILES["medium"]["name"][$k]);
        $ext = pathinfo($medium, PATHINFO_EXTENSION);

        if (in_array($ext, $imageList)) {
            $type = "photo";
        }
        if (in_array($ext, $videoList)) {
            $type = "video";
        }
		if (in_array($ext, $pdfList)) {
			$type = "pdf";
		}
		
		//4 random numbers before filename for identification
		
		$digits = 4;
		$prename = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
		
		$server_url = "/bestanden/media/" . $type . "/" . $prename . $medium;
		$url = $_SERVER["DOCUMENT_ROOT"] . "/bestanden/media/" . $type . "/" . $prename . $medium;
		//$url = "/bestanden/media/" . $type . "/" . $medium;
		
        if (move_uploaded_file($_FILES["medium"]["tmp_name"][$k], $url)) {
			if ($type == "pdf") {
				$save_file = $_SERVER["DOCUMENT_ROOT"] . "/media/foto/" . $prename . $medium;
				$save_file = substr($save_file, 0, -3) . "jpg";
				$server_save_file = "/bestanden/media/foto/" . $prename . $medium;
				$save_file = substr($save_file, 0, -3) . "jpg";
				// create Imagick object
				$imagick = new Imagick();
				$imagick->setResolution(150, 150);
				// Reads image from PDF
				$imagick->readImage("{$url}[0]");
				// Writes an image or image sequence Example- converted-0.jpg, converted-1.jpg
				// copy file to new folder and select that file
				$imagick->setImageFormat('jpg');
				$imagick->writeImages($save_file, false);
				
				$stmt = $conn->prepare("INSERT INTO file (location, type) VALUES (?,?)");
				$stmt->execute(array($server_save_file, "foto"));
				$lastInsertedFileId[$counter] = $conn->lastInsertId();
				
			} else {
				$stmt = $conn->prepare("INSERT INTO file (location, type) VALUES (?,?)");
				$stmt->execute(array($server_url, $type));
				$lastInsertedFileId[$counter] = $conn->lastInsertId();
			}
			
		}
		$counter ++;
    }
	return $lastInsertedFileId;
}

?>