$(document).ready(function () {
  // New Location Button Event
  $(".newLocation_btn").on("click", function () {
    var location_name = $(".newLocation_form").val();
    if (location_name) {
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "index.php?controller=admin/newLocation_ajax",
        data: { location_name },
        success: function (res) {
          $(".success_modal").show();
          //window.location = "index.php?controller=admin/locationList";
        },
        error: function (jqXHR, exception, error) {
          console.log(exception);
          if(exception == 'parsererror')
            $(".error_location_add_modal").show();
        },
      });
    } else {
    }
  });

  $(".success_btn").on("click", function () {
    window.location = 'index.php?controller=admin/locationList';
  });

  $(".error_btn").on("click", function () {
    $(".error_location_add_modal").hide();
  });
});
