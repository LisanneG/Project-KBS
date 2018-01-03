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
		var title = button.data("title") // Extract info from data-title attribute
		var description = button.data("description") // Extract info from data-description attribute
		var priority = button.data("priority") // Extract info from data-priority attribute
		var displayFrom = button.data("display-from") // Extract info from data-display-from attribute
		var displayTill = button.data("display-till") // Extract info from data-display-till attribute
		var category = button.data("category-id") // Extract info from data-category-id attribute
		var fileLocation = button.data("file-location") // Extract info from data-file-location attribute
		var locations = button.data("location") // Extract info from data-location attribute
		if (locations.length >= 3){
			var arrlocations = locations.split(',') // Split locations into an array
		}
		
		var modal = $(this)
		modal.find("#news-title").val(title);
		modal.find(".oldimg img")
			.prop('src', fileLocation)
			.css('margin-bottom', '15px')
			.css('max-height', '300px')
			.css('max-width', '600px');
		modal.find("#news-category").each( function (){
			if ($(this).prop('value') == category) {
				$(this).prop('checked', true);
			}
		});
		if (priority != 0) {
			modal.find("#news-priority").prop('checked', true);
		}
		modal.find("#news-date-from").val(displayFrom);
		modal.find("#news-date-till").val(displayTill);
		modal.find("#news-location").each( function (){
			if (isset(arrlocations)) {
				if (arrlocations.indexOf($(this).prop('value')) != -1){
					$(this).prop('checked', true);
				}
			} else {
				if ($(this).prop('value') == locations) {
					$(this).prop('checked', true);
				}
			}
		});
		modal.find("#news-description").val(description);
		modal.find("#newsarticle-id").val(id);
	});

	//reset all checkboxes on hiding modal
	$("#editNews").on("hidden.bs.modal", function (event) {
		var modal = $(this)
		$("#news-file").val('');
		$button = modal.find('button');
		$button.each( function(){
			$button
				.removeClass('btn-primary active')
				.addClass('btn-default');
		});
		$checkbox = modal.find('input:checkbox');
		$checkbox.each( function(){
			$checkbox
				.prop('checked', false);
		});
	});

	//Modal for the newsarticle removal
	$("#modal-remove-news").on("show.bs.modal", function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var id = button.data("id") // Extract info from data-id attribute
		var title = button.data("title") // Extract info from data-name attribute
		
		var modal = $(this)
		modal.find("#news-title").text(title);
		modal.find("#news-id").val(id);
	});

	//When the button is clicked to edit a newsarticle
	$("#save-news-edit").click(function(){
		var news_title = $("#editNews #news-title").val();
		var news_description = $("#editNews #news-description").val();
		var news_id = $("#editNews #newsarticle-id").val();
		var news_priority = $("#editNews #news-priority").val();
		var news_display_from = $("#editNews #news-date-from").val();
		var news_display_till = $("#editNews #news-date-till").val();
		var news_category = $("#editNews #news-category").val();
		var news_file = $("#editNews #news-file").prop('files')[0];
		//news_file: news_file
		var locations = "";
		$("#editNews").find("#news-location").each( function (){
			if ($(this).is(':checked')){
				locations = locations+","+$(this).prop('value');
			}
		});
		if (window.console) console.log(news_file); 
		var file = document.getElementById('news-file').files[0];
		
		var formElement = document.querySelector("#form-edit-modal");
		var formData = new FormData(formElement);
		var request = new XMLHttpRequest();
		request.open("POST", "http://localhost/KBS/Project-KBS/dashboard/get/news_article.php", false);
		formData.append("method","edit");
		formData.append("news-description",$("#news-description").prop('value'));
		formData.append("locations",locations);
		formData.append("newsarticle_id",news_id);
		request.send(formData);
		
		
		if (window.console) console.log(request.response); 
		for (var pair of formData.entries())
		{
			if (window.console) console.log(pair[0]+ ', '+ pair[1]); 
		}
		console.log(formData.get('file'));
		LoadNewsArticles(); //Loading the newsarticles again			

		//if (window.console) console.log(formData.values()); 
		$('#editNews').modal('hide'); //Closing the modal
	});

	//When the button is clicked to delete a newsarticle
	$("#btn-remove-news").click(function(){
		var id = $("#modal-remove-news #news-id").val();
    	console.log(id);
    	$.get("../dashboard/get/news_article.php?method=remove&newsarticle_id="+id, function(data) {
			$("#message").html(data); //Putting the message inside a div tag
			LoadNewsArticles(); //Loading the newsarticles again
			$('#modal-remove-news').modal('hide'); //Closing the modal
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
		modal.find("#right-title").text(name);
		modal.find("#right-id").val(id);
	});

	//When the button is clicked to edit a right
	$("#save-right-edit").click(function(){
		var right_name = $("#editRight #right-name").val();
		var right_description = $("#editRight #right-description").val();
		var right_id = $("#editRight #right-id").val();

		//Check if theyre not nothing
		if(right_name != "" && right_description != ""){
			$.get("../get/right.php?method=edit&right_id="+right_id+"&name="+right_name+"&description="+right_description, function(data) {
				$("#message").html(data); //Putting the message inside a div tag
				LoadRights(); //Loading the rights again			
			});
		} else {
			$("#message").html("<div class=\"alert alert-warning\" role=\"alert\">Naam en beschrijving zijn verplicht</div>");
		}

		
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

	//Modal for the layout remove
	$("#modal-remove-layout").on("show.bs.modal", function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id = button.data("id"); // Extract info from data-id attribute
		
		var modal = $(this);
		modal.find("#layout_id").val(id);
	});

	//Modal for the layout edit
	$("#modal-edit-layout").on("show.bs.modal", function (event) {
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id = button.data("id"); // Extract info from data-id attribute
		var font = button.data("font");
		var fontcolor = button.data("fontcolor");
		var backgroundcolor = button.data("backgroundcolor");
		var default_background = button.data("defaultbackground");
		var logo = button.data("logo");
		var backgroundlocation = button.data("backgroundlocation");
		var logolocation = button.data("logolocation");
		
		var modal = $(this)
		modal.find("#edit_layout_id").val(id);
		modal.find("#edit_layout_font").val(font)
		modal.find("#edit_layout_font_color").val(fontcolor)
		modal.find("#edit_layout_background_color").val(backgroundcolor)
		modal.find("#edit_layout_default_background").attr("src",backgroundlocation);
		modal.find("#edit_layout_logo").attr("src",logolocation);
		modal.find("#edit_default_background").val(default_background);
		modal.find("#edit_logo").val(logo);
		modal.find("#edit_logo_location").val(logolocation);
		modal.find("#edit_background_location").val(backgroundlocation);
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

function isset () {
    // !No description available for isset. @php.js developers: Please update the function summary text file.
    // 
    // version: 1103.1210
    // discuss at: http://phpjs.org/functions/isset
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: FremyCompany
    // +   improved by: Onno Marsman
    // +   improved by: Rafał Kukawski
    // *     example 1: isset( undefined, true);
    // *     returns 1: false
    // *     example 2: isset( 'Kevin van Zonneveld' );
    // *     returns 2: true
    var a = arguments,
        l = a.length,
        i = 0,
        undef;

    if (l === 0) {
        throw new Error('Empty isset');
    }

    while (i !== l) {
        if (a[i] === undef || a[i] === null) {
            return false;
        }
        i++;
    }
    return true;
}