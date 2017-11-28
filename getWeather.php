<?php
$appid = "3a4b1f37b4d0db0b03ccf7d50f906471"; //Setting the api key for the api we use

if (isset($_GET['location_name']) && $appid != "") { //Check if theres a location name and appid
	ini_set("allow_url_fopen", 1);
	$location_name = $_GET['location_name'];
	
	$url = "api.openweathermap.org/data/2.5/forecast?q=$location_name&APPID=$appid";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);

	$obj = json_decode($result); //Puttin the results inside a object

	$week_days = array(1 => 'Maandag', 2 => 'Dinsdag', 3 => 'Woensdag', 4 => 'Donderdag', 5 => 'Vrijdag', 6 => 'Zaterdag', 0 => 'Zondag');
	$output_temp = array();
	$output_icon = array();

	foreach ($obj->list as $value) { //Going through the info we need
		$temp = ($value->main->temp) - 273.15; //converting kelvin to celcius for the right temp
		$date = new DateTime($value->dt_txt); //Formating the given date to a datetime		
		$week_day = $week_days[$date->format('w')]; //Getting the info of which week day it is

		if (isset($value->weather[0])) { //A check to be sure the weather has at least something in the array to avoid error messages
			$icon = "<img src='http://openweathermap.org/img/w/".$value->weather[0]->icon.".png'>";
		}

		//Putting the temp inside an array with the weekday, so we can make an average temp per day
		if (isset($output_temp[$week_day])) {
			$output_temp[$week_day] .= "$temp;";
		} else {
			$output_temp[$week_day] = "$temp;";
		}

		$output_icon[$week_day] = $icon; //Getting the last icon from a specific day
	}

	echo "<div class=\"row\">";

	foreach ($week_days as $key => $day) { //Going through every week day

		if (isset($output_icon[$day]) && isset($output_temp[$day])) { //Checking if the weekday exists inside the arrays
			$icon = $output_icon[$day];
			$temps = explode(";", $output_temp[$day]);
			$avg_temp = 0;

			foreach ($temps as $temp) {
				$avg_temp += $temp;
			}

			$avg_temp = number_format(($avg_temp / (count($temps) - 1)), 1); //Getting the average of the temp and - 1 because the last one is always an empty string (bcs it ends with ;)

			echo "<div class=\"col-md-2\">";
			echo "	$icon<br>$avg_temp &deg; ($day)<br>";
			echo "</div>";
		}

	}

	echo "</div>";
}
?>