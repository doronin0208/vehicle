<?php
include_once 'models/snapshots.php';

$user_fullname = $_SESSION['user_fullname'];
$location_id = $_SESSION['location_id'];
$reg_num = $_GET['regi_num'];
$visit_date = $_GET['visit_date'];

$upload_times = null;
$plate_numbers = null;

if($reg_num !== '')
    $upload_times = get_searchResult_byNum($conn, $location_id, $reg_num);
else
    $plate_numbers = get_searchResult_byDate($conn, $location_id, $visit_date);

if ($upload_times || $plate_numbers) {
    $_SESSION['plate_num'] = $reg_num;
    $_SESSION['visite_date'] = $visit_date;
    include 'views/pages/user/searchResult.php';
} else {
    include 'views/pages/user/search.php';
}
