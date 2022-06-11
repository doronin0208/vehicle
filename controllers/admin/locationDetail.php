<?php
include_once 'models/users.php';
include_once 'models/devices.php';
include_once 'models/locations.php';

$location_id = isset($_GET['id']) ? $_GET['id'] : $_POST['location_id'];
$user_fullname = $_SESSION['user_fullname'];

$field = "location_id = '" . $location_id . "'";
$users = get_user_by_field($conn, $field);
$devices = get_device_by_field($conn, $field);

// $field = "role = 500 AND location_id IS NULL ";
// $allUsers = get_user_by_field($conn, $field);

$field = "location_id IS NULL ";
$allDevices = get_device_by_field($conn, $field);

if (isset($_POST['user_add'])) {
    
    $user[0] = $_POST['user_name'];
    $user[1] = $_POST['user_fullname'];
    $user[2] = $_SESSION['account_id'];
    $user[3] = $_POST['location_id'];
    $user[4] = 0;
    $user[5] = $_POST['role'];
    $date = new DateTime("now", new DateTimeZone('Europe/Berlin') );
    $user[6] = $date->format('Y/m/d H:i:s');
    $user[7] = $_SESSION['id'];
    $user[8] = $_POST['user_email'];

    if (add_user($conn, $user)) {
        echo json_encode(array("status" => true, "message" => "Add user Success"));
        return;
    } else {
        echo json_encode(array("status" => false, "message" => "Add user Failed"));
        return;
    }

} else if(isset($_POST['device_modify'])){
    $device_id = $_POST['deviceId'];
    $location_id = $_POST['location_id'];

    if (add_location_toDevice($conn, $device_id, $location_id)) {
        echo json_encode(array("status" => true, "message" => "Upload Success"));
        return;
    } else {
        echo json_encode(array("status" => false, "message" => "Upload Failed"));
        return;
    }

}else if(isset($_POST['location_modify'])){
    $location_id = $_POST['location_id'];
    $location_name = $_POST['update_name'];

    if (update_location_name($conn, $location_id, $location_name)) {
        echo json_encode(array("status" => true, "message" => "Update Success"));
        return;
    } else {
        echo json_encode(array("status" => false, "message" => "Update Failed"));
        return;
    }

} else if (isset($_POST['device_id'])) {
    $device_id = $_POST['device_id'];

    if (remove_device($conn, $device_id)) {
        echo json_encode(array("status" => true, "message" => "Upload Success"));
        return;
    } else {
        echo json_encode(array("status" => false, "message" => "Upload Failed"));
        return;
    }
} else if (isset($_POST['user_id'])){

    $user_id = $_POST['user_id'];

    if (remove_user($conn, $user_id)) {
        echo json_encode(array("status" => true, "message" => "Upload Success"));
        return;
    } else {
        echo json_encode(array("status" => false, "message" => "Upload Failed"));
        return;
    }

} 
else{
    $location_name = get_location_name($conn, $location_id);
    include 'views/pages/admin/locationDetail.php';
}
