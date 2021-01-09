<?php
    session_start();
    require_once("../database-function.php");
    require_once("./login.php");
    if(isset($_POST['adLogin'])){
        $sql = "select password,role from users where username = ?";
        $user = simpleQuery($sql, 1, [$_POST['username']]);
        if(count($user) > 0){
            if(password_verify($_POST['password'], $user[0]['password'])){
                login($_POST['username'], $user[0]['role']);
                echo "ok";
            }else{
                echo "Sai ten tai khoan hoac mat khau";
            }

        }else{
            echo 'Sai ten tai khoan hoac mat khau';
        }
    }
?>