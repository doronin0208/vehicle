<?php
include_once 'models/snapshots.php';
$user_fullname = $_SESSION['user_fullname'];
if (isset($_GET['type'], $_POST['downloadPath'])) {

    $path = $_POST['downloadPath'];

    //$plateNumber = $_POST['plateNumber'];
    
    if (is_file($path)) {
        if (file_exists($path)) {
            echo json_encode(['filename' => $path, 'result' => true]);
        }
    } else {

        $date = $_POST['uploadTime'];
        $zipcreated = "./download/".$date.".zip";

        $dir = opendir("./download/");
        while($file = readdir($dir)) {
            if(is_file("./download/".$file) && file_exists("./download/".$file)) {
                unlink("./download/".$file);
            }
        }
        
        $snapshots = $_POST['images'];

        // Create new zip class
        $zip = new ZipArchive;
        
        if($zip -> open($zipcreated, ZipArchive::CREATE ) === TRUE) {

            foreach($snapshots as $snapshot) {
                if(is_file($snapshot['path'])) {
                    $filename = $snapshot['license_plate']."_".basename($snapshot['path']);
                    $zip -> addFile($snapshot['path'], basename($filename));
                }
            }
            $zip ->close();
            
            if (file_exists($zipcreated)) {
                echo json_encode(['filename' => $zipcreated, 'result' => true]);
            }
        }
    }

    return false;
} else {
    $upload_time = isset($_GET['upload_time']) ? $_GET['upload_time'] : $_SESSION['visite_date'];
    $reg_num = isset($_GET['plate_number']) ? $_GET['plate_number'] : '';
    $location_id = $_SESSION['location_id'];

    $snapshots = get_gallery($conn, $location_id, $reg_num, $upload_time);
    include 'views/pages/user/gallery.php';
}

// Download Created Zip file
//   if(isset($_POST['download'])){

//     $filename = "myzipfile.zip";

//     if (file_exists($filename)) {
//        header('Content-Type: application/zip');
//        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
//        header('Content-Length: ' . filesize($filename));

//        flush();
//        readfile($filename);
//        // delete file
//        unlink($filename);

//      }
//   }