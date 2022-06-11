<?php
include_once('models/locations.php');

if (isset($_POST['location_name'])){

    $location[0] = $_POST['location_name'];
    $location[1] = $_SESSION['id'];
    $location[2] = 0;
    $date = new DateTime("now", new DateTimeZone('Europe/Berlin') );
    $location[3] = $date->format('Y/m/d H:i:s');
    $location[4] = $_SESSION['account_id'];

    $res = add_location($conn, $location);

    if($res)
        echo true;
    else
        echo false;
}