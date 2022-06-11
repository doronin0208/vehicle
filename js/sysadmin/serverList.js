var id;
function deleteServer(server_id) {
  // initialModal(id);
  $(".remove_modal").show();

  $(".remove_modal .button_group .agree").on("click", function () {
    $(".remove_modal").hide();
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "index.php?controller=sysadmin/serverList",
      data: { id : server_id },
      success: function (res) {
        if(res.status == true){
          window.location = "index.php?controller=sysadmin/serverList";
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

function editServer($id, $serverName, $serverUrl, $bucketName, $accessKey, $secretKey, $writtable)
{
  id = $id;

  document.getElementById("servername").value = $serverName;
  document.getElementById("server_url").value = $serverUrl;
  document.getElementById("bucket_name").value = $bucketName;
  document.getElementById("accessKey").value = $accessKey;
  document.getElementById("secretKey").value = $secretKey;
  document.getElementById("checkbox").checked = $writtable == 't' ? true : false;
  
  $(".server_edit_modal_container").show();  
}

$(document).ready(function () {
    // Pagination Init
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
        "index.php?controller=sysadmin/serverList&page=" +
        page;
      },
    });

    $(".deviceSearch").on("keypress", function (e) {
      if (e.keyCode == 13) {
        var filter = $(".deviceSearch").val();
        currentPage = 1;
        window.location =
          "index.php?controller=sysadmin/deviceList&page=" +
          currentPage +
          "&filter=" +
          filter;
      }
    });
  

    // Add New Server Button Event
    $(".addServer-btn").on("click", function () {
      window.location = 'index.php?controller=sysadmin/newServer';
    });

    $(".success_btn").on("click", function () {
      window.location = 'index.php?controller=sysadmin/serverList';
    });

    $(".server_edit_modal_container .modal_footer .edit_cancel").on("click", function () {
      $(".server_edit_modal_container").hide();
    });
  
    $(".server_edit_modal_container .modal_footer .edit_agree").on("click", function () {
      $(".server_edit_modal_container").hide();
  
      var serverName = $("#servername").val();
      var serverUrl = $("#server_url").val();
      var bucketName = $("#bucket_name").val();
      var accessKey = $("#accessKey").val();
      var secretKey = $("#secretKey").val();
      var writable = document.getElementById("checkbox").checked;
      var modify = true;
      console.log(document.getElementById("checkbox").checked);
  
      if(serverName && serverUrl && bucketName && accessKey && secretKey){
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "index.php?controller=sysadmin/newServer_ajax",
          data: {id, serverName, serverUrl, bucketName, accessKey, secretKey, writable, modify},
          success: function (res) {
            if(res == true){
              $(".success_modal").show();
            }
          },
          error: function(err){
            console.log(err);
          }
        });
      }else{
  
      }
    });
    
  });