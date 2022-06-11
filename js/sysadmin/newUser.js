function setAccount(id, name) {
  $("#newAccount .popup").toggle();
  $(".account_name").html(name);
  $(".account_id").val(id);
}

var userRole = 200;
var format = /[ `!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?~]/;

$(document).ready(function () {
  
  var left = $(".selectBox").position().left;
  var top = $(".selectBox").position().top;
  var width = $(".selectBox")[0].offsetWidth;
  $(".popup").css({ top: top, left: left + width + 10 });
  
  console.log(loginLole);
  if(loginLole == 100)
    $(".selectBox").css({ background: "#949494", opacity: ".21" });

  $(".selectBox").on("click", function () {
    if(userRole != 200){
      $("#newAccount .popup").toggle();
    }
  });  

  // Select user Box Event
  $(".selectUser").on("change", function () {
    userRole = changeBack();
  });
  // Change backgrond color of location
  function changeBack() {
    var user = $(".selectUser").val();
    if (user === "Sysadmin") {
      $(".selectBox").css({ background: "#949494", opacity: ".21" });
    } else {
      $(".selectBox").css({ background: "#fff", opacity: "1" });
    }

    switch (user){
      case "Sysadmin":
        userRole = 200;
        break;
      case "Admin":
        userRole = 400;
        break;
      case "User":
        userRole = 500;
        break;
      default:
        userRole = 500;
        break;
    }

    console.log(userRole);
    return userRole;
  }

  $(".newAccount_btn").on("click", function () {
    var user_name = $(".user_name").val();
    var user_fullname = $(".user_fullname").val();
    var email = $(".email").val();
    var account_id = userRole == 200 ? accountID : $(".account_id").val();
    if(account_id < 1){
      $("#error_message").html("Proszę wybrać Konto");
      $(".error_user_add_modal").show();
      return;
    }
    
    if(!user_name) $("#empty_username").css("display", "block"); else $("#empty_username").css("display", "none");
    if(!user_fullname) $("#user_fullname").css("display", "block"); else $("#user_fullname").css("display", "none");
    if(!email) $("#user_email").css("display", "block"); else $("#user_email").css("display", "none");

    if(format.test(user_name)) {$("#regular_username").css("display", "block"); return;} else $("#regular_username").css("display", "none");

    if (user_name && user_fullname && email) {
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "index.php?controller=sysadmin/newUser_ajax",
        data: { user_name, user_fullname, email, userRole, account_id },
        success: function (res) {
          console.log(res.status);
          if(res.status == true){
            $(".success_modal").show();
            //window.location = 'index.php?controller=sysadmin/userList';
          }else{
	    $(".error_user_add_modal").show();
	  }
        },
        error: function (jqXHR, exception, error) {
          console.log(exception);
          if(exception == 'parsererror')
            $("#error_message").html("Użytkownik o takiej nazwie już istnieje");
            $(".error_user_add_modal").show();
        },
      });
    } else {
      //alert("please input items correctly");
    }
  });

  $(".success_btn").on("click", function () {
    window.location = 'index.php?controller=sysadmin/userList';
  });

  $(".error_btn").on("click", function () {
    $(".error_user_add_modal").hide();
  });
  
});
