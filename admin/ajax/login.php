<?php
    function login(string $username, string $role){
        $_SESSION['cse-login'] = "true";
        $_SESSION['cse-username'] = $username;
        $_SESSION['cse-role'] = $role;
    }

?>