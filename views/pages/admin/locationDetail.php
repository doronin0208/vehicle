<?php
include_once 'views/pages/admin/header.php';
include_once 'views/pages/admin/navbar.php';
?>
      <div class="wrapper">
        <div id="locationDetail" class="hoc clear">
          <div class="locationDetail_container">
            <div class="heading">
              <h2> <?php echo $location_name ?> </h2>
              <img
                  src="views/images/admin/setting.png"
                  alt="setting"
                  id="editLocationName"
                  class="location_edit"
              />
            </div>
            <div class="content">
              <div class="left_bar list_box">
                <div class="list_header">
                  <img src="views/images/admin/setting.svg" alt="setting" />
                  <p class="header_title">LISTA URZĄDZEŃ</p>
                </div>
                <div class="content_box">
                  <ul class="list_content">
                    <?php
                    if($devices){
                      foreach($devices as $devices) { ?>
                        <li class="list_item">
                          <h4><?php echo $devices['serial_num'] ?></h4>
                          <img src="views/images/admin/close.svg" alt="close" onclick="removeDevice(<?php echo $devices['id'] ?>)"/>
                        </li>
                    <?php }} ?>  
                  </ul>
                  <div class="add_device">
                    <img src="views/images/admin/add.svg" alt="add-icon" />
                  </div>
                </div>
              </div>

              <div class="right_bar list_box">
                <div class="list_header">
                  <img src="views/images/admin/user.svg" alt="user-icon" />
                  <p class="header_title">LISTA UŻYTKOWNIKÓW</p>
                </div>
                <div class="content_box">
                  <ul class="list_content">
                    <?php
                      if($users){
                        foreach($users as $user) { ?>
                          <li class="list_item">
                            <h4><?php echo $user['user_name'] ?></h4>
                            <img src="views/images/admin/close.svg" alt="close" onclick="removeUser(<?php echo $user['id'] ?>)"/>
                          </li>
                    <?php }} ?>
                  </ul>
                  <div class="add_user">
                    <img src="views/images/admin/add.svg" alt="add-icon" />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="add_to_user_modal" class="add_to_device_modal add_user">
      <div class="modal_content">
        <div class="header">
          <p>DODAJ UŻYTKOWNIKA</p>
        </div>
        <div class="content">
          <input type="text" class="user_form" placeholder="NAZWA UŻYTKOWNIKA" id="user_name">
          <input type="text" class="user_form" placeholder="IMIĘ I NAZWISKO" id="user_fullname">
          <input type="text" class="user_form" placeholder="E-MAIL" id="user_email">
          <div class="modal_footer">
            <button class="cancel_btn user_cancel_btn">ANULUJ</button>
            <button class="add_btn user_modify_btn">ZAPISZ</button>
          </div>
        </div>
      </div>
    </div>

  <div id="add_to_device_modal" class="add_to_device_modal add_device">
    <div class="modal_content">
      <div class="header">
        <p>DODAJ URZĄDZENIE</p>
      </div>
      <div class="content">
        <select id="selectDevice" name="selectDevice" class="user_form selectDevice">
          <option value = "0" name="#">--- Wybierz urządzenie ---</option>
          <?php
            if($allDevices) {
              foreach($allDevices as $device) { ?>
              <option value= "<?php echo $device["id"] ?>"><?php echo $device["serial_num"] ?></option>
          <?php }} ?>
        </select>
        <div class="modal_footer">
          <button class="cancel_btn device_cancel_btn">Anuluj</button>
          <button class="add_btn device_modify_btn">ZAPISZ</button>
        </div>
      </div>
    </div>
  </div>

  <div class="edit_location_modal">
    <div class="modal_content">
      <div class="header">
        <p>Edytuj nazwę lokalizacji</p>
      </div>
      <div class="content">
        <input type="text" class="user_form" placeholder="location name" id="location_name">
        <div class="modal_footer">
          <button class="cancel_btn location_cancel_btn">ANULUJ</button>
          <button class="add_btn location_modify_btn">
            ZAPISZ
          </button>
        </div>
      </div>
    </div>
  </div>


  <link rel="stylesheet" href="views/layout/styles/admin/locationDetail.css" />
  <script>
    var location_id = <?php echo $location_id ?>;
    var location_name = "<?php echo $location_name ?>";
  </script>
  <script src="js/admin/locationDetail.js"></script>


<?php
include_once 'views/pages/admin/footer.php';
?>
