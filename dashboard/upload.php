<?php
if (isset($_POST["submit"]) && isset($_FILES["medium"]["name"])) {
	$imageList = array("png", "jpeg", "jpg", "gif");
	$videoList = array("mp4", "avi");
	$pdfList = array("pdf");
	$counter = 0;
	$lastInsertedFileId = array();
	$type = "";
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
		
		$server_url = "/KBS/Project-KBS/bestanden/media/" . $type . "/" . $prename . $medium;
		$url = $_SERVER["DOCUMENT_ROOT"] . "/KBS/Project-KBS/bestanden/media/" . $type . "/" . $prename . $medium;
		//$url = "/bestanden/media/" . $type . "/" . $medium;
		
        if (move_uploaded_file($_FILES["medium"]["tmp_name"][$k], $url)) {
			if ($type == "pdf") {
				$save_file = $_SERVER["DOCUMENT_ROOT"] . "/KBS/Project-KBS/bestanden/media/foto/" . $prename . $medium;
				$save_file = substr($save_file, 0, -3) . "jpg";
				$server_save_file = "/KBS/Project-KBS/bestanden/media/foto/" . $prename . $medium;
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
} elseif (isset($_FILES["file"]["name"]) && $method == "edit") {
	$imageList = array("png", "jpeg", "jpg", "gif");
	$videoList = array("mp4", "avi");
	$pdfList = array("pdf");
	$counter = 0;
	$lastInsertedFileId = array();
	print_r($_FILES["file"]);
	foreach ($_FILES["file"]["name"] as $k => $v) {
        $medium = str_replace(" ", "_", $_FILES["file"]["name"][$k]);
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
		
		$server_url = "/KBS/Project-KBS/bestanden/media/" . $type . "/" . $prename . $medium;
		$url = $_SERVER["DOCUMENT_ROOT"] . "/KBS/Project-KBS/bestanden/media/" . $type . "/" . $prename . $medium;
		//$url = "/bestanden/media/" . $type . "/" . $medium;
		
        if (move_uploaded_file($_FILES["file"]["tmp_name"][$k], $url)) {
			if ($type == "pdf") {
				$save_file = $_SERVER["DOCUMENT_ROOT"] . "/KBS/Project-KBS/bestanden/media/foto/" . $prename . $medium;
				$save_file = substr($save_file, 0, -3) . "jpg";
				$server_save_file = "/KBS/Project-KBS/bestanden/media/foto/" . $prename . $medium;
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
	
}
/*
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 10000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
} */
?>