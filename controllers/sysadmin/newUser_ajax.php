<?php
include_once('models/users.php');
include_once('models/locations.php');
include_once('models/mailer.php');

if(isset($_POST['modify'], $_POST['username'], $_POST['fullname'], $_POST['email'])){
    $user_name = $_POST['username'];
    $user_fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $id = $_POST['id'];

    if(update_user($conn, $id, $user_name, $user_fullname, $email, 0)){
        echo json_encode(array("status" => true, "message" => "Upload Success"));
        return;
    }else{
        echo json_encode(array("status" => false, "message" => "Upload Failed"));
        return;
    }        
    
}else
if (isset($_POST['user_name'], $_POST['user_fullname'], $_POST['email'], $_POST['account_id'], $_POST['userRole'])){
    
    $user[0] = $_POST['user_name'];
    $user[1] = $_POST['user_fullname'];
    $user[2] = $_POST['account_id'];
    $user[3] = "null";
    $user[4] = 0;
    $user[5] = $_POST['userRole'];
    $date = new DateTime("now", new DateTimeZone('Europe/Berlin') );
    $user[6] = $date->format('Y/m/d H:i:s');
    $user[7] = $_SESSION['id'];
    $user[8] = $_POST['email'];

    $res = add_user($conn, $user);

    //$id = get_id_byEmail($conn, $user[8]);

    if($res){ // $res && send_mail($_POST['email'], $id)
        echo json_encode(array("status" => true, "message" => "user register successfully"));
        return;
    }
    else
    {
        echo json_encode(array("status" => false, "message" => "user register failed"));
        return;
    }
}