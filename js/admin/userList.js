function deleteUser(id) {
  // initialModal(id);
  $(".remove_modal").show();

  $(".remove_modal .button_group .agree").on("click", function () {
    $(".remove_modal").hide();
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "index.php?controller=admin/userList",
        data: { id },
        success: function (res) {
          if(res.status == true){
            window.location = "index.php?controller=admin/userList";
          }
        },
        error: function(err){
          console.log(err);
        }
      });
  });
  // Modal Cancel Button Event
  $(".remove_modal .button_group .cancel").on("click", function () {
    $(".remove_modal").hide();
  });
}

function editUser($id, $user_name, $user_fullname, $email, $location_id, $role) {

  document.getElementById("edit_name").value = $user_name;
  document.getElementById("edit_fullname").value = $user_fullname;
  document.getElementById("edit_email").value = $email;
  var selectElement = document.getElementById("selectLocation");

  for (let i = 0; i < selectElement.length; i++ ) {
    if(selectElement[i].value == $location_id) {
      selectElement.options[i].selected = true;
    }else{
      selectElement.options[i].selected = false;
    }
  }
  
  if($role == 400)
    document.getElementById("selectLocation").setAttribute("disabled", "disabled");

  $(".user_edit_modal_container").show();

  $(".user_edit_modal_container .modal_footer .cancel").on("click", function () {
    $(".user_edit_modal_container").hide();
  });

  $(".user_edit_modal_container .modal_footer .agree").on("click", function () {
    $(".user_edit_modal_container").hide();

    var user_name = $("#edit_name").val();
    var user_fullname = $("#edit_fullname").val();
    var email = $("#edit_email").val();
    var location = $("#selectLocation").val();
    var modify = true;

    if(user_name && user_fullname && email && modify){
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "index.php?controller=admin/newUser_ajax",
        data: {id:$id, username : user_name, fullname : user_fullname, email : email, modify : modify, location : location},
        success: function (res) {
          if(res.status == true){
            window.location = "index.php?controller=admin/userList";
          }
        },
        error: function(err){
          console.log(err);
        }
      });
    }else{

    }
  });
}

$(document).ready(function () {
  $("#pagination").pagination({
    items: pages,
    itemOnPage: 8,
    currentPage: currentPage,
    cssStyle: "light-theme",
    prevText: '<span aria-hidden="true"><</span>',
    nextText: '<span aria-hidden="true">></span>',
    onInit: function () {
      // fire first page loading
    },
    onPageClick: function (page, evt) {
      window.location =
        "index.php?controller=admin/userList&page=" +
        page +
        "&filter=" +
        filter;
    },
  });

  $(".userSearch").on("keypress", function (e) {
    if (e.keyCode == 13) {
      var filter = $(".userSearch").val();
      currentPage = 1;
      window.location =
        "index.php?controller=admin/userList&page=" +
        currentPage +
        "&filter=" +
        filter;
    }
  });

  $("#search_img").on("click", function () {
    var filter = $(".userSearch").val();
    currentPage = 1;
    window.location =
      "index.php?controller=admin/userList&page=" +
      currentPage +
      "&filter=" +
      filter;
  });

  $("#search_close").on("click", function(){
    document.getElementById("user_search").value = "";
    window.location = "index.php?controller=admin/userList";
  });

  $(".add_btn").on("click", function () {
    window.location = "index.php?controller=admin/newUser";
  });

});
