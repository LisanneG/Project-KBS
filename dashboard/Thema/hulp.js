$(document).ready(function(){
	setInterval('tableSelect()');
	setInterval('handleSelect()');
	setInterval('editSelect()');
});

function tableSelect(){
	var table = $("#theme-table tbody > tr");
		if(!(table.hasClass("clicked"))){
			table.click(function(){
			table.addClass("table-primary clicked");
		});
		}
		else{
			table.click(function(){
			table.removeClass("table-primary clicked");
		});
		}
	
}

function handleSelect(){
	var selected = $(".clicked td").first().text();
	var selectednames = $(".clicked td").eq(1).text();
	$("#selected-items").text(selectednames);
}


function deleteSelect(){

}


function editSelect(){
	$("[id^='edit']").click(function(){
		$("#bijwerken").modal('show');
	});
}