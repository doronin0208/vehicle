<?php
if (isset($_POST['user_name'])) {

    $username = $_POST['user_name'];
    $user_fullname = $_POST['user_fullname'];
    $email = $_POST['email'];
    $id = $_POST['id'];

    $sql = "UPDATE tbl_user SET user_name = '".$username."', user_fullname='".$user_fullname."', email='".$email."' WHERE id= ".$id;

    $res = pg_query($conn, $sql);

    if($res){
        $_SESSION['user_name'] = $username;
        $_SESSION['user_fullname'] = $user_fullname;
        $_SESSION['email'] = $email;
        echo true;
    }        
    else
        echo false;

}
