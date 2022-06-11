<?php
function count_users($conn, $filter, $role)
{
    // Get the total number of results
    if ($filter) {
        $sql_where = "AND (LOWER(tu.user_name) like LOWER('%" . $filter . "%') OR LOWER(tu.user_fullname) like LOWER('%" . $filter . "%') OR LOWER(tu.email) like LOWER('%" . $filter . "%') OR LOWER(tl.location_name) LIKE LOWER('%" . $filter . "%') ) AND tu.flag_del = 0";
    } else {
        $sql_where = "AND tu.flag_del = 0";
    }

    if($role == 100 || $role == 200)
        $sql = "SELECT COUNT(*) FROM tbl_user as tu LEFT JOIN tbl_account AS ta ON ta.id = tu.account_id LEFT JOIN tbl_location AS tl ON tl.id = tu.location_id WHERE role > $role " . $sql_where;
    else
        $sql = "SELECT COUNT(*) FROM tbl_user as tu LEFT JOIN tbl_account AS ta ON ta.id = tu.account_id LEFT JOIN tbl_location AS tl ON tl.id = tu.location_id WHERE tu.creator_id =" . $_SESSION['id'] . " AND role > $role " . $sql_where;

    $result = pg_query($conn, $sql);

    return (int) pg_fetch_result($result, 0, 0);

}
function get_users_paging($conn, $page, $count_per_page, $filter, $role)
{
    if ($filter) {
        $sql_where = " AND (LOWER(tu.user_name) like LOWER('%" . $filter . "%') OR LOWER(tu.user_fullname) like LOWER('%" . $filter . "%') OR LOWER(tu.email) like LOWER('%" . $filter . "%') OR LOWER(tl.location_name) LIKE LOWER('%" . $filter . "%')) AND tu.flag_del = 0";
    } else {
        $sql_where = " AND tu.flag_del = 0";
    }

    $offset = ($page - 1) * $count_per_page;
    if ($offset < 0) {
        $offset = 0;
    }

    if($role == 100 || $role == 200)
        $sql = "SELECT tu.*, ta.account_name, ta.account_fullname, tl.location_name FROM tbl_user as tu LEFT JOIN tbl_account AS ta ON ta.id = tu.account_id LEFT JOIN tbl_location AS tl ON tl.id = tu.location_id WHERE role > $role " . $sql_where . " ORDER BY tu.id LIMIT  $count_per_page offset $offset";
    else
        $sql = "SELECT tu.*, ta.account_name, ta.account_fullname, tl.location_name FROM tbl_user as tu LEFT JOIN tbl_account AS ta ON ta.id = tu.account_id LEFT JOIN tbl_location AS tl ON tl.id = tu.location_id WHERE tu.creator_id =" . $_SESSION['id'] . " AND role > $role " . $sql_where . " ORDER BY tu.id LIMIT  $count_per_page offset $offset";

    //print_r($sql);
    $result = pg_query($conn, $sql);
    if (!$result) {
        echo "An error occurred.\n";
        exit;
    }
    $users = pg_fetch_all($result);

    return $users;
}

function add_user($conn, $user)
{
    $res = pg_query($conn, ("INSERT INTO tbl_user (user_name, user_fullname, account_id, location_id, flag_del, role, created_at, creator_id, email)
                            VALUES ('" . $user[0] . "','" . $user[1] . "', '" . $user[2] . "', " . $user[3] . ", '" . $user[4] . "', '" . $user[5] . "', '" . $user[6] . "', '" . $user[7] . "', '" . $user[8] . "')")); //.$_SESSION['id']."', '".$id."', 0)
    
    if($res)
        return true;
    else
        return false;
}

function add_admin($conn, $user)
{
    $res = pg_query($conn, ("INSERT INTO tbl_user (user_name, user_fullname, account_id, location_id, flag_del, role, created_at, creator_id, email, password)
                            VALUES ('" . $user[0] . "','" . $user[1] . "', '" . $user[2] . "', " . $user[3] . ", '" . $user[4] . "', '" . $user[5] . "', '" . $user[6] . "', '" . $user[7] . "', '" . $user[8] . "', '" . $user[9] . "')")); //.$_SESSION['id']."', '".$id."', 0)
    if($res)
        return true;
}

function get_all_users($conn)
{
    $sql = "SELECT tu.*, ta.account_name, ta.account_fullname FROM tbl_user as tu LEFT JOIN tbl_account AS ta ON ta.id = tu.account_id WHERE tu.creator_id =" . $_SESSION['id'] . " ORDER BY tu.id";

    $result = pg_query($conn, $sql);
    if (!$result) {
        echo "An error occurred.\n";
        exit;
    }
    $users = pg_fetch_all($result);

    return $users;
}

function get_all_admins($conn, $id)
{
    $sql = "SELECT * FROM tbl_user WHERE (role = 300 or role = 400) AND account_id = ".$id;
    //print_r($sql);
    $result = pg_query($conn, $sql);
    if (!$result) {
        echo "An error occurred.\n";
        exit;
    }
    $users = pg_fetch_all($result);

    return $users;
}

function delete_user($conn, $id)
{

    $sql = "DELETE FROM tbl_user WHERE id=" . $id;
    $result = pg_query($conn, $sql);

    if (!$result) {
        return false;
    }

    return true;
}

function get_user_by_field($conn, $field)
{
    $sql = "SELECT * FROM tbl_user WHERE " . $field;

    $result = pg_query($conn, $sql);
    if (!$result) {
        echo "An error occurred.\n";
        exit;
    }

    $users = pg_fetch_all($result);

    return $users;
}

function update_user_info($conn, $mail, $password)
{
    $sql = "UPDATE tbl_user SET password = md5('" . $password . "') WHERE email='" . $mail . "'";

    $result = pg_query($conn, $sql);
    if (!$result) {
        return false;
    }

    return true;
}

function get_id_byEmail($conn, $mail)
{
    $sql = "SELECT id FROM tbl_user WHERE email='".$mail."'";

    $result = pg_query($conn, $sql);
    
    if (!$result) {
        return -1;
    }

    return (int) pg_fetch_result($result, 0, 0);
}

function get_default_superadmin($conn)
{
    $sql = "SELECT id FROM tbl_user WHERE account_id = 1 AND role = 100";

    $result = pg_query($conn, $sql);

    if (!$result) {
        return -1;
    }

    return (int) pg_fetch_result($result, 0, 0);
}

function update_user($conn, $id, $user_name, $user_fullname, $email, $location_id){
    
    if($location_id <= 0)
        $sql = "UPDATE tbl_user SET user_name = '".$user_name."', user_fullname = '".$user_fullname."', email = '".$email."' WHERE id=" . $id;
    else
        $sql = "UPDATE tbl_user SET user_name = '".$user_name."', user_fullname = '".$user_fullname."', location_id = '".$location_id."', email = '".$email."' WHERE id=" . $id;

    //print_r($sql);
    $result = pg_query($conn, $sql);
    if (!$result) {
        return false;
    }

    return true;
}

function remove_user($conn, $user_id){

    $sql = "UPDATE tbl_user SET location_id = NULL WHERE id=".$user_id;

    $result = pg_query($conn, $sql);

    if (!$result) {
        return false;
    }

    return true;
}

function remove_user_by_accountId($conn, $account_id){

    $sql = "DELETE FROM tbl_user WHERE account_id=".$account_id;

    $result = pg_query($conn, $sql);

    if (!$result) {
        return false;
    }

    return true;
}

function get_userId_byAccontId($conn, $accountId, $account_name)
{
    $sql = "SELECT id FROM tbl_user WHERE account_id = '".$userId."' AND user_name = '".$user_name;

    $result = pg_query($conn, $sql);

    if (!$result) {
        return -1;
    }

    return (int) pg_fetch_result($result, 0, 0);
}

function update_user_account($conn, $id, $newAminId, $prevAminId){
    $sql = "UPDATE tbl_user SET role = 300 WHERE id=".$newAminId;
    $result = pg_query($conn, $sql);

    if (!$result) {
        return false;
    }

    $sql = "UPDATE tbl_user SET role = 400 WHERE id=".$prevAminId;
    $result = pg_query($conn, $sql);

    if (!$result) {
        return false;
    }

    return true;
}