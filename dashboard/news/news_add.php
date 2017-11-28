<?php 
	include '../../database.php';
	
	$stmt = $conn->prepare("SELECT name FROM location");
	$stmt->execute();
	$locations = $stmt->fetchAll();

	
	
	$stmt = $conn->prepare("SELECT * FROM location");
	$stmt->execute();
	$locations = $stmt->fetchAll();
	
	
	foreach ($locations as $location) {
		print($location["name"]."<br>");
	}
	
	
	
?>
<?= $locations; ?>
