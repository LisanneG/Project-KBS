$(document).ready(function() {
    //LoadWeather("Zwolle");

	$('[data-toggle="popover"]').popover();
});

function LoadWeather(locatie_naam){
	$.get("getWeather.php?locatie_naam="+locatie_naam, function(data) {
		$("#weather").html(data);
	});
}