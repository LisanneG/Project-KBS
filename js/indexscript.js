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
        $("#weather").addClass("offset-1");
    }
    else{
        $("div.row").addClass("justify-content-center");
        $("div.container-fluid").removeClass("container-fluid").addClass("container");
    }
}


function MessageScroll(){
    $("html, body").animate({scrollTop: 0});

    var timer0 = 0;
    var timer1 = 1000;

    var Listlength = $("ul.list-unstyle.mw-50 > li").length;
    for(i = 0; i < Listlength; i++){
        timer0 = ListScroll(i);
        if(timer0 === undefined){
            timer0 = 0;
        }
        timer1 = timer1 + timer0;

    }            
    for(i = Listlength; i != 0; i--){
        timer0 = ListScroll(i);
        if(timer0 === undefined){
            timer0 = 0;
        }
        timer1 = timer1 + timer0;
    }    

    if(!($(".alert.alert-info")[0])){
        setTimeout('location.reload(true)' ,(timer1));
    }
}


function ListScroll(i, length){
    //speed is avg 250 words-per-minute
    //1 word is 5 characters
    //250 / 60 = 4.17 words-per-second
    //20.83 character per second
    //txtlength / 20.83 + 2 * 1000 = seconds of display
    var listitem = $("li.media.mb-5.mt-5.border.border-dark").eq(i);
        if($(listitem).is("[id$='-messagevideowithnosound']")){
            var list = listitem;
            var video = $(list).find("div > video").get(0);     
            video.autoplay = false;
            video.muted = false;
            var vidlength = (video.duration) * 1000 + 5000;
            console.log(vidlength);

            $("html, body").animate({ scrollTop: ($(list).offset().top - 300)},2000, function(){video.play();}).delay(vidlength);       
            
            return vidlength + 2000;
        }
        else if($(listitem).is("[id$='-message']")){
            var item = listitem;
            var delay = (($(".messagecontent01").text().length) / 20.83 + 2 )*50;
            $("html, body").animate({ scrollTop: ($(item).offset().top - 300)}, 2000).delay((($(".messagecontent01").text().length) / 20.83 + 2 )*50);
            return delay + 2000;
        }
        else if($(listitem).is("li[id$='-birthdayimg']")){
            var item = listitem;
            $("html, body").animate({ scrollTop: ($(item).offset().top - 300)}, 2000).delay(2000);
            return 4000;
        }
        else if($(listitem).is("li[id$='-birthdaynoimg']")){
            var item = listitem;
            $("html, body").animate({ scrollTop: ($(item).offset().top - 300)}, 2000).delay(2000);
            return 4000;
        }
        else if($(listitem).is("li[id$='-messageimg']")){
            var item = listitem;
            var delay = (($(".messagecontent01").text().length) / 20.83 + 2 )*50;
            $("html, body").animate({ scrollTop: ($(item).offset().top) - 300}, 2000).delay((($(".messagecontent01").text().length) / 20.83 + 2 )*50);
            return delay + 2000;
            
        }
        else if($(listitem).is("li[id$='-messagevideo']")){
            var list = listitem;
            var video = $(list).find("div > video").get(0);     
            video.autoplay = false;
            video.muted = false;
            var vidlength = (video.duration) * 1000 + 5000;
            console.log(vidlength);

            $("html, body").animate({ scrollTop: ($(list).offset().top - 300)},2000, function(){video.play();}).delay(vidlength);       
            
            return vidlength + 2000;
            }
        }



function LoadWeather(location_name){
	$.get("dashboard/get/getWeather.php?location_name="+location_name+"&type=mainscreen", function(data) {
		$("#weather").html(data);		
	});
}