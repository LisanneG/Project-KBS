function updateClock(){


    $("#date").html($.format.date(new Date().getTime(), "dd-MM-yyyy"));
    $("#time").html($.format.date(new Date().getTime(), "HH:mm"));


}


$(document).ready(function(){

    setInterval('updateClock()', 1000);
    scroll($('html, .container'), 10000);
    //MessageScroll();
    //LoadWeather("Zwolle");
});



function scroll(element, speed) {
    element.animate({ scrollTop: $("html, .container").height() }, speed, function() {
        $(this).animate({ scrollTop: 0 }, speed, scroll(element, speed), 5000);
    });
}


function MessageScroll(){
    var Listlength = $("ul.list-unstyle.mw-50 > li").length;
    for(i = 0; i < Listlength; i++){
        ListScroll(i);
    }
    for(i = Listlength; i != 0; i--){
        ListScroll(i);
    }
    $("html, body").animate({ scrollTop: $("#weather").height()}, 1000);
    setTimeout(function(){ $("html, body").animate({ scrollTop: 0}, 1000)}, 10000);

    
    MessageScroll();
}

function ListScroll(i){
    var listitem = $("li.media.mb-5.mt-5.border.border-dark").eq(i);
        if($(listitem).attr("[id$='-video']")){
            $("html, body").animate({ scrollTop: $(listitem).height()});
            var video = $(listitem).find("video");            
            video.autoplay = false;
            video.muted = true;
            var vidlength = (video.duration) * 1000;
            video.play();
            setTimeout(function(){}, (vidlength + 10000));
        }
        else if($(listitem).attr("[id$='-message']")){
            $("html, body").animate({ scrollTop: $(listitem).height()});
            setTimeout(function(){}, 10000);
        }
        else if($(listitem).attr("[id$='-birthdayimg']")){
            $("html, body").animate({ scrollTop: $(listitem).height()});
            setTimeout(function(){}, 10000);
        }
        else if($(listitem).attr("[id$='-birthdaynoimg']")){
            $("html, body").animate({ scrollTop: $(listitem).height()});
            setTimeout(function(){}, 10000);
        }
        else if($(listitem).attr("[id$='-messageimg']")){
            $("html, body").animate({ scrollTop: $(listitem).height()});
            setTimeout(function(){}, 10000);
        }
}


function LoadWeather(locatie_naam){
	$.get("getWeather.php?location_name="+locatie_naam, function(data) {
		$("#weather").text(data);
	});
}