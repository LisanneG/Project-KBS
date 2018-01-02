function updateClock(){


    $("#date").html($.format.date(new Date().getTime(), "dd-MM-yyyy"));
    $("#time").html($.format.date(new Date().getTime(), "HH:mm"));


}


$(document).ready(function(){
   
    if($("video")[0]){
    var videoLoaded = false;
    }

    var videoLoad = setInterval(function(videoLoaded){
        
        if(videoLoaded === undefined){
            startPage(videoLoad);
            return;
        }
        var video = $("#messagediv").find("video").get(0);
        if (video.readyState > 0) {
          videoLoaded = true;
          startPage(videoLoad);
        }

    });

});




function startPage(videoLoad){
    //Getting the location name
    clearInterval(videoLoad);
    location_name = $("#location_name").html();
	LoadWeather(location_name);
    setInterval('updateClock()', 1000);
    MessageScroll();
    Checkpriority();
    setInterval('console.log($(document).scrollTop())', 2000);
}



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

    var video

    
    $("html, body").animate({scrollTop: 0});

    var timer0 = 0;
    var timer1 = 1000;

    var Listlength = $("ul.list-unstyle.mw-50 > li").length;
    for(i = 0; i < Listlength; i++){
        timer0 = ListScroll(i);
        console.log(i);
        if(timer0 === undefined){
            timer0 = 0;
        }
        timer1 = timer1 + timer0;

    }            
    for(i = Listlength; i != -1; i--){
        timer0 = ListScroll(i);
        console.log(i);
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

    var navbar = $("#top-bar").height() + 48;

    var listitem = $("li.media.mb-5.mt-5.border.border-dark").eq(i);
        if($(listitem).is("[id$='-messagevideowithnosound']")){
            var list = listitem;
            var video = $(list).find("div > video").get(0);     
            video.autoplay = false;
            video.muted = true;
            var vidlength = (video.duration) * 1000 + 5000;
            console.log(vidlength);
            if($(list).index() == 0){
            $("html, body").animate({ scrollTop: ($(list).offset().top - navbar)},2000, function(){video.play();}).delay(vidlength);       
            }
            else{
            $("html, body").animate({ scrollTop: ($(list).offset().top - navbar + 320)},2000, function(){video.play();}).delay(vidlength);       
            }
            return vidlength + 2000;
        }
        else if($(listitem).is("[id$='-message']")){
            var item = listitem;
            var delay = (($(".messagecontent01").text().length) / 20.83 + 2 )*50;
            $("html, body").animate({ scrollTop: ($(item).offset().top - navbar)}, 2000).delay((($(".messagecontent01").text().length) / 20.83 + 2 )*50);
            return delay + 2000;
        }
        else if($(listitem).is("li[id$='-birthdayimg']")){
            var item = listitem;
            $("html, body").animate({ scrollTop: ($(item).offset().top - navbar)}, 2000).delay(2000);
            return 4000;
        }
        else if($(listitem).is("li[id$='-birthdaynoimg']")){
            var item = listitem;
            $("html, body").animate({ scrollTop: ($(item).offset().top - navbar)}, 2000).delay(2000);
            console.log($(item).offset().top);
            return 4000;
        }
        else if($(listitem).is("li[id$='-messageimg']")){
            var item = listitem;
            var delay = (($(".messagecontent01").text().length) / 20.83 + 2 )*50;
            $("html, body").animate({ scrollTop: ($(item).offset().top) - navbar}, 2000).delay((($(".messagecontent01").text().length) / 20.83 + 2 )*50);
            console.log($(item).offset().top);
            return delay + 2000;
            
        }
        else if($(listitem).is("li[id$='-messagevideo']")){
            var list = listitem;
            var video = $(list).find("div > video").get(0);     
            video.autoplay = false;
            video.muted = false;
            var vidlength = (video.duration) * 1000 + 5000;
            console.log(vidlength);

            if($(list).index() == 0){
                $("html, body").animate({ scrollTop: ($(list).offset().top - navbar)},2000, function(){video.play();}).delay(vidlength);       
            }
            else{
                $("html, body").animate({ scrollTop: ($(list).offset().top - navbar + 320)},2000, function(){video.play();}).delay(vidlength);       
            }   
            console.log($(video).offset().top);
            
            return vidlength + 2000;
            }
        }



function LoadWeather(location_name){
	$.get("dashboard/get/getWeather.php?location_name="+location_name+"&type=mainscreen", function(data) {
		$("#weather").html(data);		
	});
}