$(document).ready(function () {
    // Return Button Event
    $(".return_search_btn").on("click", function () {
      window.location = "index.php?controller=user/search";
    });

    // Item Click Event
    $(".list_box .list_content li").on("click", function () {
      var value = $(this).closest('li').data('value'); // = time
      if(b_search)
        window.location = "index.php?controller=user/gallery&plate_number="+value;
      else
        window.location = "index.php?controller=user/gallery&upload_time="+value;
    });
  });