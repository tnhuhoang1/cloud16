<?php
    session_start();


    function hLogin($username, $user_id, $role){
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['status'] = "logged";
        $_SESSION['user_id'] = $user_id;
    }


?>