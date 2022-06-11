var device_id, user_id;
function removeDevice(deviceId) {
  $(".remove_modal").show();

  device_id = deviceId;
}

function removeUser(userId) {
  $(".remove_modal").show();

  user_id = userId; 
}

$(document).ready(function () {
  // Add Button Event
  $(".right_bar .add_user").on("click", function () {
    $("#add_to_user_modal").show();
  });

  $(".left_bar .add_device").on("click", function () {
    $("#add_to_device_modal").show();
  });

  $(".user_cancel_btn").on("click", function () {
    $(".add_to_device_modal").hide();
  });

  $(".device_cancel_btn").on("click", function () {
    $(".add_to_device_modal").hide();
  });

  $(".user_modify_btn").on("click", function () {
    
    var user_name = $("#user_name").val();
    var user_fullname = $("#user_fullname").val();
    var user_email = $("#user_email").val();
    var role = 500;
    var user_add = true;

    $.ajax({
      type: "POST",
      dataType: "json",
      url: "index.php?controller=admin/locationDetail",
      data: { user_name, user_fullname, location_id, role, user_email, user_add },
      success: function (res) {
        if (res.status == true) {
          $(".add_to_device_modal").hide();
          window.location =
            "index.php?controller=admin/locationDetail&id=" + location_id;
        }
      },
      error: function (err) {
        console.log(err);
      },
    });
  });

  $(".device_modify_btn").on("click", function () {
    $(".add_to_device_modal").hide();

    var deviceId = $("#selectDevice").val();
    var device_modify = true;
    
    if(deviceId == 0) {
      alert("Please select device");
      return;
    }

    $.ajax({
      type: "POST",
      dataType: "json",
      url: "index.php?controller=admin/locationDetail",
      data: { deviceId, location_id, device_modify },
      success: function (res) {
        if (res.status == true) {
          window.location =
            "index.php?controller=admin/locationDetail&id=" + location_id;
        }
      },
      error: function (err) {
        console.log(err);
      },
    });
  });

  $(".remove_modal .button_group .agree").on("click", function () {    
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "index.php?controller=admin/locationDetail",
      data: {location_id,  device_id, user_id },
      success: function (res) {
        if (res.status == true) {
          $(".remove_modal").hide();
          window.location =
            "index.php?controller=admin/locationDetail&id=" + location_id;
        } else {
          console.log(res.message);
        }
      },
      error: function (err) {
        console.log(err);
      },
    });
  });

  // Modal Cancel Button Event
  $(".remove_modal .button_group .cancel").on("click", function () {
    $(".remove_modal").hide();
  });

  $("#editLocationName").on('click', function() {
    document.getElementById("location_name").value = location_name;
    $(".edit_location_modal").show();
  })

  $(".edit_location_modal .modal_footer .cancel_btn").on("click", function () {
    $(".edit_location_modal").hide();
  });

  $(".edit_location_modal .modal_footer .add_btn").on("click", function () {
    var update_name = $("#location_name").val();
    var location_modify = true;

    if(update_name == "")
    {
      alert("input location name");
      return;
    }
    
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "index.php?controller=admin/locationDetail",
      data: {location_id, update_name, location_modify},
      success: function (res) {
        if (res.status == true) {
          $(".edit_location_modal").hide();
          window.location =
            "index.php?controller=admin/locationDetail&id=" + location_id;
        } else {
          console.log(res.message);
        }
      },
      error: function (err) {
        console.log(err);
      },
    });
  });

});
