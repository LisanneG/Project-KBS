function updateClock(){
    var currentTime = new Date();

    var currentHours = currentTime.getHours();
    var currentMinutes = currentTime.getMinutes();
    var currentDay = currentTime.getDate();
    var currentMonth = currentTime.getMonth();
    var currentYear = currentTime.getFullYear();

    var date = currentDay + "-" + currentMonth + "-" + currentYear;
    var time = currentHours + ":" + currentMinutes;


    $("#date").html(date);
    $("#time").html(time);


}


$(document).ready(function(){
    setInterval('updateClock()', 1000);
});