$(document).ready(function () {

  var daylist = ["niedziela","poniedziałek","Wtorek","Środa ","Czwartek","piątek","sobota"];
  
  var timeDisplay = document.getElementById("time");
  var dateDisplay = document.getElementById("date");

  function refreshTime() {
    var date = new Date();

    var cur_time = 
        (date.getHours() >= 10 ? date.getHours() : "0" + date.getHours()) +
        ":" +
        (date.getMinutes() >= 10 ? date.getMinutes() : "0" + date.getMinutes());

    timeDisplay.innerHTML = cur_time;
  }

  function refreshDate(){
    var date = new Date();
    
    var day = date.getDay();

    
    var cur_date =
        " " + (date.getDate() >= 10 ? date.getDate() : "0" + date.getDate()) + "." + ((date.getMonth() + 1) >= 10 ? (date.getMonth() + 1) : ("0" + (date.getMonth() + 1))) + "." + date.getFullYear();

    dateDisplay.innerHTML = daylist[day] + cur_date;
  }

  setInterval(refreshTime, 1000);
  setInterval(refreshDate, 1000);
});
