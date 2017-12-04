<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="birthday.css">
</head>
<body>

<?php

include 'database.php';

$stmt = $conn->prepare("SELECT * FROM user");
$stmt->execute();
while ($row = $stmt->fetch()) 
{	$year = date("Y");
	$today = date("m-d");
	$date = date("Y-m-d");
	$birthday_temp = $row["birthday"];
	$birthday = substr($birthday_temp, 5);
	$age_temp = substr($birthday_temp, 0, -6);
	$age = ($year-$age_temp);
	
	if($birthday == $today){
					$age_temp = substr($birthday_temp, 0, -6);
					$age = ($year-$age_temp);
		$sql_insert_birthday = ("INSERT INTO birthday (user_id, category_id, file_id ) VALUES(" . $row["user_id"] .", 1, NULL)");
		$conn->exec($sql_insert_birthday);
		//to delete birthdays use: DELETE FROM birthday WHERE date < '2017-12-04'
	}	
	
	
}
 







print "</br>";
print "</br>";
print "</br>";
print $age;
print "</br>";
print $today;
print "</br>";
print $birthday;
print "</br>";
print $date;

?>
</body>
</html>