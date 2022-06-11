$(document).ready(function () {
  // Button Event
  $(".search_btn").on("click", function () {
    var regi_num = $(".regi_num").val();
    var visit_date = $(".visit_date").val();

    if (regi_num || visit_date){
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "index.php?controller=user/searchResult_ajax",
        data: {location_id, regi_num, visit_date},
        success: function (res) {
          if(res == true){
            window.location = 'index.php?controller=user/searchResult&regi_num=' + regi_num + "&visit_date=" + visit_date;
          }
        },
        error: function(err){
          console.log(err);
          if ($(".search_alert").css("visibility","visible")) {
            setTimeout(function(){$(".search_alert").css("visibility","hidden"); document.getElementById("regi_num").value = ""; document.getElementById("visit_date").value = ""},2000)
          }
        }
      });
    }      
    else {
      // if ($(".search_alert").css("visibility","visible")) {
      //   setTimeout(function(){$(".search_alert").css("visibility","hidden")},2000)
      // }
    }
  });

});
