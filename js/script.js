$(document).ready(function() {
	//Loading the rights
	LoadRights();

	//Loading the articles
	LoadNewsArticles();

    //When another location is selected
    $("#locations").on("change", function() {
		var location_name = $("#locations option:selected").text();
		var location_id = $("#locations option:selected").val();

		if(location_id != ""){
			LoadWeather(location_name);
			LoadNewsArticle(location_id);
			LoadBirthdays(location_id);
		}
		
	});

	//When another person is selected for the rights
    $("#rights-users").on("change", function() {
		var user_name = $("#rights-users option:selected").text();
		var user_id = $("#rights-users option:selected").val();

		if(user_id != ""){			
			$("#user-rights-table").css("display", "table"); //Showing the table
			LoadUserRights(user_id);
		} else {
			$("#user-rights-table").css("display", "none"); //Hiding the table if no user is selected
		}
		
	});

	$("[data-toggle=\"popover\"]").popover();
	
	//Modal for the newsarticle edit
	$("#editNews").on("show.bs.modal", function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var id = button.data("id") // Extract info from data-id attribute
		var title = button.data("title") // Extract info from data-name attribute
		var description = button.data("description") // Extract info from data-description attribute
		
		var modal = $(this)
		modal.find("#right-name").val(name);
		modal.find("#right-description").val(description);
		modal.find("#right-id").val(id);
	});

	//Modal for the newsarticle removal
	$("#modal-remove-news").on("show.bs.modal", function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var id = button.data("id") // Extract info from data-id attribute
		var title = button.data("title") // Extract info from data-name attribute
		
		var modal = $(this)
		modal.find("right-title").text(name);
		modal.find("#right-id").val(id);
	});

	//When the button is clicked to edit a newsarticle
	$("#save-right-edit").click(function(){
		var right_name = $("#editRight #right-name").val();
		var right_description = $("#editRight #right-description").val();
		var right_id = $("#editRight #right-id").val();

		$.get("../get/right.php?method=edit&right_id="+right_id+"&name="+right_name+"&description="+right_description, function(data) {
			$("#message").html(data); //Putting the message inside a div tag
			LoadRights(); //Loading the rights again			
		});
	});

	//When the button is clicked to delete a newsarticle
	$("#btn-remove-right").click(function(){
		var right_id = $("#modal-remove-right #right-id").val();
    	
    	$.get("../get/right.php?method=remove&right_id="+right_id, function(data) {
			$("#message").html(data); //Putting the message inside a div tag
			LoadRights(); //Loading the rights again
			$('#modal-remove-right').modal('hide'); //Closing the modal
		});
	});	
	
	//Modal for the right edit
	$("#editRight").on("show.bs.modal", function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var id = button.data("id") // Extract info from data-id attribute
		var name = button.data("name") // Extract info from data-name attribute
		var description = button.data("description") // Extract info from data-description attribute
		
		var modal = $(this)
		modal.find("#right-name").val(name);
		modal.find("#right-description").val(description);
		modal.find("#right-id").val(id);
	});

	//Modal for the right remove
	$("#modal-remove-right").on("show.bs.modal", function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var id = button.data("id") // Extract info from data-id attribute
		var name = button.data("name") // Extract info from data-name attribute
		
		var modal = $(this)
		modal.find("right-title").text(name);
		modal.find("#right-id").val(id);
	});

	//When the button is clicked to edit a right
	$("#save-right-edit").click(function(){
		var right_name = $("#editRight #right-name").val();
		var right_description = $("#editRight #right-description").val();
		var right_id = $("#editRight #right-id").val();

		$.get("../get/right.php?method=edit&right_id="+right_id+"&name="+right_name+"&description="+right_description, function(data) {
			$("#message").html(data); //Putting the message inside a div tag
			LoadRights(); //Loading the rights again			
		});
	});

	//When the button is clicked to delete a right
	$("#btn-remove-right").click(function(){
		var right_id = $("#modal-remove-right #right-id").val();
    	
    	$.get("../get/right.php?method=remove&right_id="+right_id, function(data) {
			$("#message").html(data); //Putting the message inside a div tag
			LoadRights(); //Loading the rights again
			$('#modal-remove-right').modal('hide'); //Closing the modal
		});
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

function LoadNewsArticles(){
	$.get("../dashboard/get/getNewsArticle.php?newsManage=yes", function(data) {
		$("#newsArticles-tbody").html(data); //Putting the articles information inside a tbody tag
	});
}