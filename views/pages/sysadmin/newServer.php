<?php 
	 include_once('views/pages/sysadmin/header.php');
   include_once('views/pages/sysadmin/navbar.php');
?>
  <div class="wrapper main_content">
    <div id="newServer" class="hoc clear">
      <div class="newServer_container">
        <div class="newServer_card">
          <div class="header">
            <img
              src="views/images/sysadmin/newServer-icon.svg"
              alt="new-server-icon"
            />
            <p class="search_header_content">DODAWANIE NOWEGO SERWERA</p>
          </div>
          <div class="content">
            <input
              type="text"
              placeholder="Nazwa serwera"
              class="newServer_form server_name"
            />
	    <div id="server_name" class="error">Pole wymagane</div>
            <input
              type="text"
              placeholder="Adres URL"
              class="newServer_form server_url"
            />
	    <div id="server_url" class="error">Pole wymagane</div>
            <input
              type="text"
              placeholder="Bucket"
              class="newServer_form bucket_name"
            />
	    <div id="bucket_name" class="error">Pole wymagane</div>
            <input
              type="text"
              placeholder="Access key ID"
              class="newServer_form access_key"
            />
	    <div id="access_key" class="error">Pole wymagane</div>
            <input
              type="text"
              placeholder="Secret access key"
              class="newServer_form secret_access_key"
            />
	    <div id="secret_access_key" class="error">Pole wymagane</div>
            <div class="newServer_form checkBox">
              <p class="title">Zapis</p>
              <label class="switch">
                <input class="checkbox" type="checkbox" id="writtable" />
                <span class="slider round"></span>
              </label>
            </div>
          </div>
        </div>
        <button class="newServer_btn">DODAJ SERWER</button>
      </div>
    </div>
  </div>

<link rel="stylesheet" href="views/layout/styles/sysadmin/newServer.css" />
<script src="js/sysadmin/newServer.js"></script>

<?php 
include_once('views/pages/sysadmin/footer.php');
?>
