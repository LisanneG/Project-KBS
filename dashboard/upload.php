<?php
$imageList = array("png", "jpeg", "jpg", "gif");
$videoList = array("mp4", "avi");
$pdfList = array("pdf");
if (isset($_POST["submit"])) {
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

        $url = $_SERVER["DOCUMENT_ROOT"] . "/KBS/Project-KBS/bestanden/media/" . $type . "/" . $medium;

        if (move_uploaded_file($_FILES["medium"]["tmp_name"][$k], $url)) {
			$stmt = $conn->prepare("INSERT INTO file (location, type) VALUES ('".$url."','".$type."')");
			$stmt->execute();
			$lastInsertedFileId[$counter] = $conn->lastInsertId();
			
			if ($type == "pdf") {
				// create Imagick object
				$imagick = new Imagick();
				$imagick->setResolution(150, 150);
				// Reads image from PDF
				$imagick->readImage($url);
				// Writes an image or image sequence Example- converted-0.jpg, converted-1.jpg
				//copy file to new folder and select that file
				$imagick->writeImages('converted.jpg', false);
			}
			
		}
		$counter ++;
    }
}
/*
    print ("<h2><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>");
    foreach ($_FILES["medium"]["name"] as $k => $v) {
        print $_FILES["medium"]["name"][$k];
        print (" ");
    }
    print ("toegevoegd</h2>");
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 10000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
return $target_file;
} */
?>