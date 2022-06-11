<script type="text/javascript">
    var id = '<?php echo $_SESSION['id']; ?>';
    var user_name = '<?php echo $_SESSION['user_name']; ?>';
    var user_fullname = '<?php echo $_SESSION['user_fullname']; ?>';
    var email = '<?php echo $_SESSION['email']; ?>';
    var role = <?php echo $_SESSION['role']; ?>;
</script>
      <div class="user_modal_container">
        <div class="modal_content">
          <div class="modal_header">
            <p>EDYCJA PROFILU</p>
          </div>
          <div class="modal_card">
            <div class="user_info_field">
              <p>Nazwa Użytkownika / login</p>
              <input type="text" id ="update_name" class="search_form update_name" >
            </div>
            <div class="user_info_field">
              <p>Imię i nazwisko</p>
              <input type="text" id ="update_fullname" class="search_form update_fullname" >
            </div><div class="user_info_field">
              <p>Email</p>
              <input type="text" id ="update_email" class="search_form update_email" >
            </div>
            <div class="modal_footer">
              <button class="cancel modify_btn">Anuluj</button>
              <button class="profile_agree modify_btn">modyfikować</button>
            </div>
          </div>
        </div>
      </div>

      <div class="success_modal">
        <div class="success_content">
          <div class="header">
            <img src="views/images/smile.svg" alt="warn" />
          </div>
          <div class="content">
            <div class="warn_info">
              <h1>OPERACJA ZAKOŃCZONA SUKCESEM!</h1>
            </div>
            <div class="button_group">
              <button class="success_btn">OK</button>
            </div>
          </div>
        </div>
      </div>

      <div class="error_user_add_modal">
        <div class="error_content">
          <div class="header">
            <img src="views/images/sysadmin/warn.svg" alt="warn" />
          </div>
          <div class="content">
            <div class="warn_info">
              <h1 id = "error_message">Użytkownik o takiej nazwie już istnieje</h1>
            </div>
            <div class="button_group">
              <button class="error_btn">OK</button>
            </div>
          </div>
        </div>
      </div>
      <div class="error_server_add_modal">
        <div class="error_content">
          <div class="header">
            <img src="views/images/sysadmin/warn.svg" alt="warn" />
          </div>
          <div class="content">
            <div class="warn_info">
              <h1 id = "error_message">Serwer o takiej nazwie już istnieje</h1>
            </div>
            <div class="button_group">
              <button class="error_btn">OK</button>
            </div>
          </div>
        </div>
      </div>
      <div class="error_account_add_modal">
        <div class="error_content">
          <div class="header">
            <img src="views/images/sysadmin/warn.svg" alt="warn" />
          </div>
          <div class="content">
            <div class="warn_info">
              <h1 id = "error_message">To konto lub użytkownik już istnieje</h1>
            </div>
            <div class="button_group">
              <button class="error_btn">OK</button>
            </div>
          </div>
        </div>
      </div>
      <div class="wrapper custom_footer">
        <div id="copyright" class="hoc clear">
          <img src="views/images/logo.png" alt="logo" />
          <p>Wszelkie prawa zastrzeżone &copy; 2022</p>
        </div>
      </div>
    </div>
  </body>
</html>
