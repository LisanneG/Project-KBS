function updateClock(){


    $("#date").html($.format.date(new Date().getTime(), "dd-MM-yyyy"));
    $("#time").html($.format.date(new Date().getTime(), "HH:mm"));


}


$(document).ready(function(){
    //Getting the location name
    location_name = $("#location_name").html();
	LoadWeather(location_name);
    setInterval('updateClock()', 1000);
    MessageScroll();
    Checkpriority();

});

function Checkpriority(){
    if($(".priority-message")[0]){
        $("#messagediv").removeClass("col");
        $("#messagediv").addClass("offset-4 col-8");
    }
    else{
        $("div.row").addClass("justify-content-center");
        $("div.container-fluid").removeClass("container-fluid").addClass("container");
    }
}


function MessageScroll(){
    $("html, body").animate({scrollTop: 0});

    var Listlength = $("ul.list-unstyle.mw-50 > li").length;
    for(i = 0; i < Listlength; i++){
        var time = ListScroll(i);
        console.log(i);

    }
    $("html, body").animate({ scrollTop: $("#weather").offset().top}, 1000).delay(2000);                
    for(i = Listlength; i != 0; i--){
        var time = ListScroll(i);
        console.log(i);
    }    

}

//todo remove console debug lines

function ListScroll(i, length){
    //speed is avg 250 words-per-minute
    //1 word is 5 characters
    //250 / 60 = 4.17 words-per-second
    //20.83 character per second
    //txtlength / 20.83 + 2 * 1000 = seconds of display
    var listitem = $("li.media.mb-5.mt-5.border.border-dark").eq(i);
        if($(listitem).attr("[id$='-messagevideo']")){
            var list = listitem;
            var video = $(list).find("div > video").get(0);     
            video.autoplay = false;
            video.muted = true;
            var vidlength = (video.duration) * 1000 + 5000;
            console.log(vidlength);

            $("html, body").animate({ scrollTop: ($(list).offset().top - 200)},2000, function(){video.play();}).delay(vidlength);       
            
            return vidlength;
        }
        else if($(listitem).is("[id$='-message']")){
            var item = listitem;
            var delay = (($(".messagecontent01").text().length) / 20.83 + 2 )*50;
            $("html, body").animate({ scrollTop: ($(item).offset().top - 200)}, 2000).delay((($(".messagecontent01").text().length) / 20.83 + 2 )*50);
        }
        else if($(listitem).is("li[id$='-birthdayimg']")){
            var item = listitem;
            $("html, body").animate({ scrollTop: ($(item).offset().top - 200)}, 2000).delay(2000);
            return 2000;
        }
        else if($(listitem).is("li[id$='-birthdaynoimg']")){
            var item = listitem;
            $("html, body").animate({ scrollTop: ($(item).offset().top - 200)}, 2000).delay(2000);
            return 2000;
        }
        else if($(listitem).is("li[id$='-messageimg']")){
            var item = listitem;
            var delay = (($(".messagecontent01").text().length) / 20.83 + 2 )*50;
            $("html, body").animate({ scrollTop: ($(item).offset().top - 200)}, 2000).delay((($(".messagecontent01").text().length) / 20.83 + 2 )*50);
            return delay;
            
        }
        else if($(listitem).is("li[id$='-messagevideowithsound']")){
            var list = listitem;
            var video = $(list).find("div > video").get(0);     
            video.autoplay = false;
            video.muted = false;
            var vidlength = (video.duration) * 1000 + 5000;
            console.log(vidlength);

            $("html, body").animate({ scrollTop: ($(list).offset().top - 200)},2000, function(){video.play();}).delay(vidlength);       
            
            return vidlength;
            }
        }



function LoadWeather(location_name){
	$.get("dashboard/get/getWeather.php?location_name="+location_name, function(data) {
		$("#weather").html(data);		
	});
}