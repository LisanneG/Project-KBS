<?php
if (isset($_POST["submit"]) && isset($_FILES["medium"]["name"])) {
	$imageList = array("png", "jpeg", "jpg", "gif");
	$videoList = array("mp4", "avi");
	$pdfList = array("pdf");
	$counter = 0;
	$lastInsertedFileId = array();
	foreach ($_FILES["medium"]["name"] as $k => $v) {
        $medium = str_replace(" ", "_", $_FILES["medium"]["name"][$k]);
        $ext = pathinfo($medium, PATHINFO_EXTENSION);

        if (in_array($ext, $imageList)) {
            $type = "foto";
        }
        if (in_array($ext, $videoList)) {
            $type = "video";
        }
		if (in_array($ext, $pdfList)) {
			$type = "pdf";
		}
		
		//maybe random numbers b4 filename
		
		$digits = 4;
		$prename = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
		
		$url = $_SERVER["DOCUMENT_ROOT"] . "/KBS/Project-KBS/bestanden/media/" . $type . "/" . $prename . $medium;
		//$url = "/bestanden/media/" . $type . "/" . $medium;
		
        if (move_uploaded_file($_FILES["medium"]["tmp_name"][$k], $url)) {
			if ($type == "pdf") {
				$save_file = $_SERVER["DOCUMENT_ROOT"] . "/KBS/Project-KBS/bestanden/media/foto/" . $prename . $medium;
				$save_file = substr($save_file, 0, -3) . "jpg";
				// create Imagick object
				$imagick = new Imagick();
				$imagick->setResolution(300, 300);
				// Reads image from PDF
				$imagick->readImage("{$url}[0]");
				// Writes an image or image sequence Example- converted-0.jpg, converted-1.jpg
				// copy file to new folder and select that file
				$imagick->setImageFormat('jpg');
				$imagick->writeImages($save_file, false);
				
				$stmt = $conn->prepare("INSERT INTO file (location, type) VALUES (?,?)");
				$stmt->execute(array($save_file, "foto"));
				$lastInsertedFileId[$counter] = $conn->lastInsertId();
				
			} else {
				$stmt = $conn->prepare("INSERT INTO file (location, type) VALUES (?,?)");
				$stmt->execute(array($url, $type));
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