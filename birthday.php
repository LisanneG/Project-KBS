<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="birthday.css">
</head>
<body>

<?php

include 'database.php';

/*
connect to database and select all info from users.
compare the date with today
select all the people who have birthdays today
insert the user id into birthday 
delete birthdays that are older than 6 days
*/
	
	$stmt = $conn->prepare("SELECT * FROM user");
	$stmt->execute();
	$users = $stmt->fetchAll();
	
	$stmt = $conn->prepare("SELECT * FROM birthday");
	$stmt->execute();
	$birthdays = $stmt->fetchAll();
	
	
// insert users into birthday table that have birthdays in 3 days
	foreach ($users as $user){
		$birthday_exists = TRUE;
		$year = date("Y");
		$today = date("m-d");
		$date = date("Y-m-d");
		$birthday_temp = $user["birthday"];
		$birthday = substr($birthday_temp, 5);
		$age_temp = substr($birthday_temp, 0, -6);
		$age = ($year-$age_temp);
		$date_plus_days = date('m-d', strtotime($date. ' + 3 days'));
		$date_minus_days = date('m-d', strtotime($date . ' - 1 days'));
		$age_temp = substr($birthday_temp, 0, -6);
		$age = ($year-$age_temp);

		if($birthday == $date_plus_days ) {
			$birthday_exists = FALSE;			
			foreach ($birthdays as $birthday){
				if($birthday["user_id"] == $user["user_id"] && !$birthday_exists){
					$birthday_exists = TRUE;
				}
			}
		}
		if (!$birthday_exists) {
			$stmt = $conn->prepare("INSERT INTO birthday (user_id, category_id) VALUES(?,?)");
			$stmt->execute(array($user["user_id"],"1"));
		}
	}
//delete birthdays that are older than 6 days
$stmt = $conn->prepare("DELETE FROM birthday where datediff(now(), date) > 6");
$stmt->execute();

?>


</body>
</html>