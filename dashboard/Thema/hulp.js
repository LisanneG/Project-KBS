$(document).ready(function(){
	setInterval('tableSelect()');
	setInterval('deleteSelect()', 2000);
	setInterval('editSelect()');
});

function tableSelect(){
	
	var checkbox = $("[id^='checkbox']");
	$("input").on('click', function(){
		if(checkbox.is(":checked")){
		var selecteditem = checkbox.attr("id");
		selecteditem = 	selecteditem.split("-");
		$("tr#row-" + selecteditem[1]).addClass("table-primary clicked");
		}
		else{
			var selecteditem = checkbox.attr("id");
			selecteditem = selecteditem.split("-");
			$("tr#row-" + selecteditem[1]).removeClass("table-primary clicked");
		}
	});
}	


function handleSelect(){
	var selected = $(".clicked td").first().text();
	var selectednames = $(".clicked td").eq(1).text();
	$("#selected-items").text(selectednames);
	return selected;
}


function deleteSelect(){
	var selected = handleSelect();

	if(selected == ""){
		$("#deletebutton").prop("disabled", true);
		$("#deletebutton").attr("aria-disabled", true);

		
		return;
	}
	else{
		$("#deletebutton").prop("disabled", false);
		$("#deletebutton").attr("aria-disabled", false);
		$("#theme-id").val(selected);
	}
}


function editSelect(){
	$("[id^='edit']").click(function(){
		$("#bijwerken").modal('show');
		$(this).addClass("selected-edit");
	});

	if($(".selected-edit")[0]){
		var selectedId = $(".selected-edit").attr("id");
		selectedId = selectedId.split("-");
		selectedId = selectedId[1];

		$("#newtheme-edit-id").val(selectedId);
	}
	
}