<?php
    require_once("../database/database-function.php");
    require_once("helper.php");
    $errors = array();
    if(isset($_POST['log-btn'])){
        if(empty($_POST['log-username'])){
            array_push($errors, "Khong duoc de trong username");
        }else if(empty($_POST['log-password'])){
            array_push($errors, "Khong duoc de trong password");
        }else{
            //k co loi nao
            
            $sql = "select user_id, password, role from users where name = ?";
            $username = htmlentities($_POST["log-username"]);
            $username = trim($username);
            $password = $_POST["log-password"];
            $record = simpleQuery($sql,1, [$username]);
            if(password_verify($password, $record[0]['password']) == true){
                hLogin($username, $record[0]['user_id'],$record[0]['role']);
                $sql = "update user_info set last_online = now() where user_id = ?";
                simpleQuery($sql,0, [$record[0]['user_id']]);
                echo "ok";
            }else{
                echo "error";
            }
        }
        if(count($errors) > 0){
            echo "error";
        }
        
    }
    
    
?>