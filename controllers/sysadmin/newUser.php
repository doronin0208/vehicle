<?php
    include_once('models/accounts.php');
    
    $accounts = get_all_accounts($conn);
    include('views/pages/sysadmin/newUser.php');
?>