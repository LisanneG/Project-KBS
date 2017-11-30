$(document).ready(function() {
    LoadWeather("Zwolle");

	$('[data-toggle="popover"]').popover();
});

function LoadWeather(location_name){
	$.get("getWeather.php?location_name="+location_name, function(data) {
		$("#weather").html(data);		
	});
}