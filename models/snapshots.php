<?php
function get_searchResult_byNum($conn, $location_id, $reg_num) {

	
	$sql = "SELECT DATE ( upload_time ) FROM tbl_snapshot WHERE location_id = ".$location_id." AND license_plate = '".$reg_num."' GROUP BY DATE ( upload_time ) ORDER BY DATE";
	// 	$sql = "SELECT * FROM tbl_snapshot WHERE location_id = ".$location_id." AND  DATE(upload_time) = '".$visit_date."' AND license_plate = '".$reg_num."' ORDER  BY id";

	//print_r($sql);
	$result = pg_query($conn,$sql);

	if (!$result) {
	    echo "An error occurred.\n";
	    exit;
	}

	$upload_times = pg_fetch_all($result);
	
	return $upload_times;
}

function get_searchResult_byDate($conn, $location_id, $visit_date) {

	
	$sql = "SELECT license_plate FROM tbl_snapshot WHERE location_id = ".$location_id." AND DATE(upload_time) = '".$visit_date."' GROUP BY license_plate ORDER BY license_plate";
	//print_r($sql);
	$result = pg_query($conn,$sql);

	if (!$result) {
	    echo "An error occurred.\n";
	    exit;
	}

	$plate_numbers = pg_fetch_all($result);
	
	return $plate_numbers;
}


function get_gallery($conn, $location_id, $reg_num, $visit_date) {

	if(($reg_num !== '') && ($visit_date !== ''))
		$sql = "SELECT * FROM tbl_snapshot WHERE location_id = ".$location_id." AND  DATE(upload_time) = '".$visit_date."' AND license_plate = '".$reg_num."' ORDER  BY id";
	else if($reg_num !== '')
		$sql = "SELECT * FROM tbl_snapshot WHERE location_id = ".$location_id." AND  license_plate = '".$reg_num."' ORDER  BY id";
	else
		$sql = "SELECT * FROM tbl_snapshot WHERE location_id = ".$location_id." AND  DATE(upload_time) = '".$visit_date."' ORDER  BY id";	

	//print_r($sql);
	$result = pg_query($conn,$sql);

	if (!$result) {
	    echo "An error occurred.\n";
	    exit;
	}

	$snapshots = pg_fetch_all($result);
	
	return $snapshots;
}



// function get_reg_num($conn, $snapshot_id){

// 	$sql = "SELECT license_plate FROM tbl_snapshot WHERE id = ".$snapshot_id;
// 	$result = pg_query($conn,$sql);

// 	if (!$result) {
// 	    echo "An error occurred.\n";
// 	    exit;
// 	}

// 	$reg_num = pg_fetch_result($result, 0, 0);
	
// 	return $reg_num;
// }

function get_upload_time($conn, $snapshot_id){

	$sql = "SELECT upload_time FROM tbl_snapshot WHERE id = ".$snapshot_id;
	$result = pg_query($conn,$sql);

	if (!$result) {
	    echo "An error occurred.\n";
	    exit;
	}

	$upload_time = pg_fetch_result($result, 0, 0);
	
	return $upload_time;
}

function get_count_snapshots($conn, $location_id){

    $sql = "SELECT COUNT(res.license_plate)
			 FROM (SELECT COUNT(license_plate), license_plate, date(upload_time)
			 		 FROM tbl_snapshot
					   WHERE date_part('month', upload_time) = date_part('month', now()) - 1 AND location_id = ".$location_id."
					    GROUP BY license_plate, date(upload_time)
						 ORDER BY date) as res";

    $result = pg_query($conn, $sql);
    if (!$result) {
        echo "An error occurred.\n";
        exit;
    }

    $count = pg_fetch_result($result, 0, 0);
    return $count;
}