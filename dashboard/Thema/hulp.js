$(document).ready(function(){
	setInterval('deleteSelect()');
	setInterval('editSelect()');
	setInterval('cancelSelect()');
});



function handleSelect(){
	var selected = $(".clicked td").first().text();
	var selectednames = $(".clicked td").eq(1).text();
	$("#selected-items").text(selectednames);
	return selected;
}


function deleteSelect(){


	$("[id^='remove']").click(function(){
		$("#verwijderen").modal('show');
		$(this).addClass("selected-remove");
	});

	if($(".selected-remove")[0]){
		var selectedId = $(".selected-remove").attr("id");
		selectedId = selectedId.split("-");
		selectedId = selectedId[1];


		$("#theme-id").val(selectedId);

		var selectedName = $(".selected-remove").parent().siblings().eq(1).text();
		$("#selected-items-del").text(selectedName);

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


function cancelSelect(){
	$(".close").click(function(){
		if($(".selected-remove")[0]){
			$(".selected-remove").removeClass("selected-remove");
			$("#selected-items-del").text("");
			$("#theme-id").val("");
			
			
		}
		else if($(".selected-edit")[0]){
			$(".selected-edit").removeClass("selected-edit");
			$("#newtheme-edit-id").val("");
		}
	});
	$(".cancelbtn0").click(function(){
		if($(".selected-remove")[0]){
			$(".selected-remove").removeClass("selected-remove");
			$("#selected-items-del").text("");
			$("#theme-id").val("");
			
			
		}
		else if($(".selected-edit")[0]){
			$(".selected-edit").removeClass("selected-edit");
			$("#newtheme-edit-id").val("");
		}
	});
}