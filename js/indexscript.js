function updateClock(){


    $("#date").html($.format.date(new Date().getTime(), "dd-MM-yyyy"));
    $("#time").html($.format.date(new Date().getTime(), "HH:mm"));


}


$(document).ready(function(){
    //Getting the location name
    location_name = $("#location_name").html();
	LoadWeather(location_name);

    setInterval('updateClock()', 1000);
    //scroll($('html, .container'), 10000);
    MessageScroll();   
});



function scroll(element, speed) { //needs to be removed
    element.animate({ scrollTop: $("html, .container").offset().top }, speed, function() {
        $(this).animate({ scrollTop: 0 }, speed, scroll(element, speed), 5000);
    });
}


function MessageScroll(){
    $("html, body").animate({scrollTop: 0});

    var Listlength = $("ul.list-unstyle.mw-50 > li").length;
    for(i = 0; i < Listlength; i++){
        ListScroll(i);
    }
    $("html, body").animate({ scrollTop: $("#weather").offset().top}, 1000).delay(2000);                
    for(i = Listlength; i != 0; i--){
        ListScroll(i);
    }    
    

    setTimeout(MessageScroll, 5000);
}


function ListScroll(i, length){
    //speed is avg 250 words-per-minute
    //1 word is 5 characters
    //250 / 60 = 4.17 words-per-second
    //20.83 character per second
    //txtlength / 20.83 + 2 * 1000 = seconds of display
    var listitem = $("li.media.mb-5.mt-5.border.border-dark").eq(i);
        if($(listitem).attr("[id$='-messagevideo']")){
            var video = $(listitem).find("video");            
            video.autoplay = false;
            video.muted = true;
            var vidlength = (video.duration) * 1000;
            $("html, body").animate({ scrollTop: ($(listitem).offset().top - 200)},2000).queue(function(){video.play();}).delay(vidlength + 5000).dequeue();
        }
        else if($(listitem).is("[id$='-message']")){
            $("html, body").animate({ scrollTop: ($(listitem).offset().top - 200)}, 2000).delay((($(".messagecontent01").text().length) / 20.83 + 2 )*50);
        }
        else if($(listitem).is("li[id$='-birthdayimg']")){
            $("html, body").animate({ scrollTop: ($(listitem).offset().top - 200)}, 2000).delay(2000);
        }
        else if($(listitem).is("li[id$='-birthdaynoimg']")){
            $("html, body").animate({ scrollTop: ($(listitem).offset().top - 200)}, 2000).delay(2000);;
        }
        else if($(listitem).is("li[id$='-messageimg']")){
            $("html, body").animate({ scrollTop: ($(listitem).offset().top - 200)}, 2000).delay((($(".messagecontent01").text().length) / 20.83 + 2 )*50);
        }
        else if($(listitem).is("li[id$='-messagevideowithsound']")){
            var video = $(listitem).find("video");            
            video.autoplay = false;
            video.muted = false;
            var vidlength = (video.duration) * 1000;
            $("html, body").animate({ scrollTop: ($(listitem).offset().top - 50)},2000).queue(function(){video.play();}).delay(vidlength + 5000).dequeue();
        }

}

function LoadWeather(location_name){
	$.get("dashboard/get/getWeather.php?location_name="+location_name, function(data) {
		$("#weather").html(data);		
	});
}