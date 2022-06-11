<?php
   include_once('models/users.php');

   //show users list
   if(isset($_POST['id'])){
      if(delete_user($conn, $_POST['id'])){
        echo json_encode(array("status" => true, "message" => "Delete Success"));
      }else{
        echo json_encode(array("status" => false, "message" => "Delete Failed"));
      }
        return;
    }

    $filter = isset($_GET['filter']) ? $_GET['filter'] : '';
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    $countPerPage = 10;
    $role = $_SESSION['role'];
    $totalResultCount = count_users($conn, $filter, $role);

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
    
    $users = get_users_paging($conn, $page, $countPerPage, $filter, $role);
    $user_fullname = $_SESSION['user_fullname'];
    include_once 'views/pages/sysadmin/userList.php';
?>