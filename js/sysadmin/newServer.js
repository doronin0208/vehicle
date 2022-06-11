$(document).ready(function () {
  $(".newServer_btn").on("click", function () {

    var serverName = $(".server_name").val();
    var serverUrl = $(".server_url").val();
    var bucketName = $(".bucket_name").val();
    var accessKey = $(".access_key").val();
    var secretKey = $(".secret_access_key").val();
    var writable = document.getElementById("writtable").checked;

    
    if(!serverName) $("#server_name").css("display", "block"); else $("#server_name").css("display", "none");
    if(!serverUrl) $("#server_url").css("display", "block"); else $("#server_url").css("display", "none");
    if(!bucketName) $("#bucket_name").css("display", "block"); else $("#bucket_name").css("display", "none");
    if(!accessKey) $("#access_key").css("display", "block"); else $("#access_key").css("display", "none");
    if(!secretKey) $("#secret_access_key").css("display", "block"); else $("#secret_access_key").css("display", "none");

    if (serverName && serverUrl && bucketName && accessKey && secretKey) {
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "index.php?controller=sysadmin/newServer_ajax",
        data: { serverName: serverName, serverUrl: serverUrl,  bucketName: bucketName, accessKey:accessKey, secretKey:secretKey, writable:writable},
        success: function (res) {          
          if (res) {
            $(".success_modal").show();
          }
        },
        error: function (jqXHR, exception, error) {
          console.log(error);
          if(exception == 'parsererror')
            $(".error_server_add_modal").show();
          //alert("General system error");
        },
      });
    }else{
      //alert("Register correctly!");
    }
});

$(".success_btn").on("click", function () {
  window.location = 'index.php?controller=sysadmin/serverList';
});

$(".error_btn").on("click", function () {
  $(".error_server_add_modal").hide();
});
  
});