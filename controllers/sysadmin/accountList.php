<?php
    include_once 'models/accounts.php';
    include_once 'models/users.php';
    
    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    if(isset($_GET['del'])){
        delete_account_byId($conn, $_GET['del']);
        remove_user_by_accountId($conn, $_GET['del']);
    }

    if(isset($_GET['err'])){
        delete_account_byName($conn, $_GET['err']);
    }

    $countPerPage = 10;
    $totalResultCount = count_accounts($conn, $filter);
    
    // The ceil function will round floats up.
    $numberOfPages = ceil($totalResultCount / $countPerPage);
    
    // Check that the page is within our bounds
    
    if ($page <= 1) {
        $page = 1;
    } elseif ($page > $numberOfPages) {
        $page = $numberOfPages;
    }
    
    $totalResultCount -= ($page - 1) * $countPerPage;
    
    if($totalResultCount > 10 )
        $totalResultCount = 10;

    $accounts = get_accounts_paging($conn, $page, $countPerPage, $filter);
    
    include_once 'views/pages/sysadmin/accountList.php';
?>
