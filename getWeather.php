<?php
$appid = "3a4b1f37b4d0db0b03ccf7d50f906471";

if (isset($_GET['location_name']) && $appid != "") {
	ini_set("allow_url_fopen", 1);
	$location_name = $_GET['location_name'];

	//api.openweathermap.org/data/2.5/forecast?q
	$url = "https://api.openweathermap.org/data/2.5/weather?q=$location_name&APPID=$appid";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);

	$obj = json_decode($result);

	$temp = ($obj->main->temp) - 273.15; //converting kelvin to celcius for the right temp

	foreach ($obj->weather as $value) {
		$icon = "<img src='http://openweathermap.org/img/w/".$value->icon.".png'>";

		echo "$icon<br>$temp";
	}
}
?>