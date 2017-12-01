$(document).ready(function() {
    //When another location is selected
    $('#locations').on('change', function() {
		var location_name = $("#locations option:selected").text();
		LoadWeather(location_name);
	})

	$('[data-toggle="popover"]').popover();
});

function LoadWeather(location_name){
	$.get("../getWeather.php?location_name="+location_name, function(data) {
		$("#weather").html(data);		
	});
}