<?php 
	 include_once('views/pages/sysadmin/header.php');
   include_once('views/pages/sysadmin/navbar.php');
?>
<div class="wrapper">
    <div id="newAccount" class="hoc clear">
        <div class="newAccount_container">
            <div class="newAccount_card">
                <div class="header">
                    <img src="views/images/admin/add.svg" alt="add" />
                    <p class="search_header_content">
                        DODAWANIE NOWEGO UŻYTKOWNIKA
                    </p>
                </div>
                <div class="content">
                    <input type="text" placeholder="Nazwa Użytkownika / login" class="user_name newAccount_form" />
                    <div id="empty_username" class="error">Pole wymagane</div>
                    <div id="regular_username" class="error">Niedozwolony znak</div>
                    <input type="text" placeholder="Imię i nazwisko" class="user_fullname newAccount_form" />
                    <div id="user_fullname" class="error">Pole wymagane</div>
                    <input type="text" placeholder="Email" class="email newAccount_form" />
                    <div id="user_email" class="error">Pole wymagane</div>

                    <select name="selectUser" class="newAccount_form selectUser" style=<?php echo $_SESSION['role'] == 200 ? "display:none" : "display:block" ?> >
                        <option value="Sysadmin">Sysadmin</option>
                        <option value="Admin">Admin</option>
                        <!-- <option value="User">User</option> -->
                    </select>
                    <div class="newAccount_form selectBox">
                        <p class="account_name">Konta</p>
                        <input type="hidden" class="account_id" value="" />
                        <img src="views/images/admin/down-carrot.svg" alt="down-carrot" />
                    </div>
                </div>
            </div>
            <button class="newAccount_btn">DODAJ UŻYTKOWNIKA</button>
        </div>

        <div class="popup">
            <?php            
                if ($accounts) {
                  foreach ($accounts as $account) {?>
                  <div onclick="setAccount(<?php echo $account['id'] ?>, '<?php echo $account['account_name'] ?>')">
                    <?php echo $account['account_name'] ?>
                  </div>
            <?php }}?>
        </div>
    </div>
</div>

<link rel="stylesheet" href="views/layout/styles/sysadmin/newUser.css" />
<script>
    var accountID = <?php echo $_SESSION['account_id'] ?>;
    var loginLole = <?php echo $_SESSION['role'] ?>;

    var menuBtn = document.querySelector('.selectBox');
    var sidebar = document.querySelector('.popup');

    window.onclick = function(event) {
        if (event.target !== sidebar && event.target !== menuBtn) {
        sidebar.style.display = "none";
        console.log('clicked');
        }
    }
</script>
<script src="js/sysadmin/newUser.js"></script>

<?php 
include_once('views/pages/sysadmin/footer.php');
?>