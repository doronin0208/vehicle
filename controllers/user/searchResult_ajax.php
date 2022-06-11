<?php
include_once 'models/snapshots.php';

$user_fullname = $_SESSION['user_fullname'];
$location_id = isset($_POST['location_id']) ? $_POST['location_id'] : '';
$reg_num = isset($_POST['regi_num']) ? $_POST['regi_num'] : '';
$visit_date = isset($_POST['visit_date']) ? $_POST['visit_date'] : '';

$snapshots = get_gallery($conn, $location_id, $reg_num, $visit_date);
$images = null;

if ($snapshots) {
    echo true;
}else {
    echo false;
}
