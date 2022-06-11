<?php
include_once 'models/accounts.php';
include_once 'models/users.php';
include_once 'models/locations.php';

if (isset($_POST['username'], $_POST['password'])) {
    
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $res_name = pg_query($conn, ("SELECT * FROM tbl_user WHERE user_name='$username' AND password='$password' AND flag_del<>1"));
    $res_email = pg_query($conn, ("SELECT * FROM tbl_user WHERE email='$username' AND password='$password' AND flag_del<>1"));

    if (pg_num_rows($res_name) > 0 || pg_num_rows($res_email) > 0) {
        $message_ok = true;
        $user_list = pg_num_rows($res_name) > 0 ? pg_fetch_array($res_name) : pg_fetch_array($res_email);
        $_SESSION['id'] = $user_list[0];
        $_SESSION['user_name'] = $user_list[1];
        $_SESSION['user_fullname'] = $user_list[2];
        $_SESSION['account_id'] = $user_list[3];
        $_SESSION['location_id'] = $user_list[5] ? $user_list[5] : 0;
        $_SESSION['role'] = $user_list[7];
        $_SESSION['password'] = $user_list[10];
        $_SESSION['email'] = $user_list[11];
        $_SESSION['url'] = get_imageUrl($conn, $user_list[3]);
        $_SESSION['account_name'] = get_account_name($conn, $_SESSION['account_id']);
        if($_SESSION['role'] == 500 && $_SESSION['location_id'] > 0)
            $_SESSION['location_name'] = get_location_name($conn, $_SESSION['location_id']);
        
        $json = array('success' => $message_ok, 'role' => $user_list[7]);
        echo json_encode($json);
    }

}
