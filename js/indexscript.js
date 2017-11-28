function updateClock(){


    $("#date").html($.format.date(new Date().getTime(), "dd-MM-yyyy"));
    $("#time").html($.format.date(new Date().getTime(), "HH:mm"));


}


$(document).ready(function(){

    setInterval('updateClock()', 1000);
    scroll($('html, #container'), 5000);
});



function scroll(element, speed) {
    element.animate({ scrollTop: $("html, #container").height() }, speed, function() {
        $(this).animate({ scrollTop: 0 }, speed, scroll(element, speed), 5000);
    });
}