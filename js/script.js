$(document).ready(function() {
	//Loading the rights
	LoadRights();

    //When another location is selected
    $('#locations').on('change', function() {
		var location_name = $("#locations option:selected").text();
		var location_id = $("#locations option:selected").val();

		if(location_id != ""){
			LoadWeather(location_name);
			LoadNewsArticle(location_id);
			LoadBirthdays(location_id);
		}
		
	});

    //When another person is selected for the rights
    $('#rights-users').on('change', function() {
		var user_name = $("#rights-users option:selected").text();
		var user_id = $("#rights-users option:selected").val();

		if(user_id != ""){			
			$("#user-rights-table").css("visibility", "visible"); //Showing the table
			LoadUserRights(user_id);
		} else {
			$("#user-rights-table").css("visibility", "hidden"); //Hiding the table if no user is selected
		}
		
	});

	$('[data-toggle="popover"]').popover();

	//Modal for the right edit
	$('#editRight').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var id = button.data('id') // Extract info from data-id attribute
		var name = button.data('name') // Extract info from data-name attribute
		var description = button.data('description') // Extract info from data-description attribute
		
		var modal = $(this)
		modal.find('#right-name').val(name);
		modal.find('#right-description').val(description);		
	});
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

function LoadBirthdays(location_id){	
	$.get("get/getBirthday.php?location_id="+location_id, function(data) {
		$("#birthdays").html(data); //Putting the birthday information inside a div tag
	});
}

function LoadRights(){
	$.get("../get/getRight.php", function(data) {
		$("#rights-tbody").html(data); //Putting the rights information inside a tbody tag
	});
}

function LoadUserRights(user_id){
	$.get("../get/getRight.php?user_id="+user_id, function(data) {
		$("#user-rights-tbody").html(data); //Putting the rights information inside a tbody tag
	});
}