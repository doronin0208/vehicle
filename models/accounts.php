<?php

function add_account($conn, $accounts)
{
    // Get the total number of results
    $account_name = $accounts[0];
    $account_fullname = $accounts[1];
    $location = !empty($accounts[2]) ? $accounts[2] : 'null';

    if($location == 'null')
        $res = pg_query($conn, ("INSERT INTO tbl_account (account_name, account_fullname, flag_del) VALUES ('".$account_name."', '".$account_fullname."', 0)"));
    else
        $res = pg_query($conn, ("INSERT INTO tbl_account (account_name, account_fullname, flag_del, avatar_name) VALUES ('".$account_name."', '".$account_fullname."', 0, '".$location."')"));

    if ($res) {

        $is_inserted = true;

    } else {

        echo pg_last_error($conn) . " <br />";
        $is_inserted = false;

    }

    return $is_inserted;
}

function count_accounts($conn, $filter){
	// Get the total number of results
	if($filter){
        $sql_where = "(LOWER(account_name) like LOWER('%".$filter."%') OR LOWER(account_fullname) like LOWER('%".$filter."%')) AND flag_del = 0";
    }
    else{

        $sql_where = "flag_del = 0";
    }

    $sql = "SELECT COUNT(*) FROM tbl_account WHERE ".$sql_where." AND id<>1";
    
	$result = pg_query($conn, $sql);
	
	return (int)pg_fetch_result($result, 0, 0);

}

function get_accounts_paging($conn,$page,$count_per_page, $filter) {
	if($filter){
        $sql_where = "(LOWER(account_name) like LOWER('%".$filter."%') OR LOWER(account_fullname) like LOWER('%".$filter."%')) AND flag_del = 0";
    }
    else{
        $sql_where = "flag_del = 0";
    }

	$offset = ($page - 1) * $count_per_page;
    if($offset < 0)
        $offset = 0;

	$sql = "SELECT * FROM tbl_account WHERE ".$sql_where." AND id<>1 ORDER BY id LIMIT  $count_per_page offset $offset" ;

	$result = pg_query($conn,$sql);
	if (!$result) {
	    echo "An error occurred.\n";
	    exit;
	}
	$accounts = pg_fetch_all($result);

	return $accounts;
}

function get_account_id($conn, $accounts){

    $account_name = $accounts[0];
    $account_fullname = $accounts[1];

    $res = pg_query($conn, ("SELECT id FROM tbl_account WHERE account_name='$account_name' and account_fullname='$account_fullname'"));
    $res = pg_fetch_array($res);
    $id = $res[0];

    return $id;
}

function get_account_name($conn, $id){

    $res = pg_query($conn, ("SELECT account_name FROM tbl_account WHERE id ='$id'"));
    $res = pg_fetch_array($res);
    $account_name = $res[0];

    return $account_name;
}

function delete_account_byId($conn, $id){

    $sql = "DELETE FROM tbl_account WHERE id=".$id;
    $result = pg_query($conn, $sql);

    if (!$result) {
        return false;
    }

    return true;
}

function delete_account_byName($conn, $account_name){

    $sql = "DELETE FROM tbl_account WHERE account_name= '".$account_name."'";
    $result = pg_query($conn, $sql);

    if (!$result) {
        return false;
    }

    return true;
}

function update_account($conn, $id, $account_name, $account_fullname, $img_url){
    if($img_url == 'null')
        $img_url = NULL;
    
    $sql = "UPDATE tbl_account SET account_name = '".$account_name."' , account_fullname = '".$account_fullname."', avatar_name = '".$img_url."'  WHERE id=".$id;
    
    $result = pg_query($conn, $sql);

    if (!$result) {
        return false;
    }

    return true;
}

function get_all_accounts($conn)
{
    $result = pg_query($conn, ("SELECT * FROM tbl_account"));

    if (!$result) {
	    echo "An error occurred.\n";
	    exit;
	}

    $accounts = pg_fetch_all($result);
    return $accounts;
}

function get_imageUrl($conn, $id)
{    
    $result = pg_query($conn, ("SELECT avatar_name FROM tbl_account WHERE id = ".$id));

    $res = pg_fetch_array($result);

    if($res[0])
        $avatar_name = $res[0];
    else
        $avatar_name = 'views/images/logo.png';
    
    return $avatar_name;
}
