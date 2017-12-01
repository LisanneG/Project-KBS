$(document).ready(function() {
    //When another location is selected
    $('#locations').on('change', function() {
		var location_name = $("#locations option:selected").text();
		var location_id = $("#locations option:selected").val();

		LoadWeather(location_name);
		LoadNewsArticle(location_id);
	})

	$('[data-toggle="popover"]').popover();
});

function LoadWeather(location_name){
	//Starting an ajax GET call to get the weather
	$.get("get/getWeather.php?location_name="+location_name, function(data) {
		$("#weather").html(data); //Putting the weather information inside a div tag
	});
}

function LoadNewsArticle(location_id){	
	$.get("get/getNewsArticle.php?location_id="+location_id, function(data) {
		$("#news-articles").html(data); //Putting the article information inside a div tag
	});
}