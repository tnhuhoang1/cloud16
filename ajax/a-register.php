<?php
    require_once("../database/database-function.php");
    require_once("helper.php");
    if(isset($_GET['res-username']) && isset($_GET['res-email'])){
        $sql = "select user_id from users where name = ? or email = ?";
        $username = htmlentities($_GET["res-username"]);
        $username = trim($username);
        $email = $_GET["res-email"];
        $record = simpleQuery($sql,1, [$username, $email]);
        if(count($record) == 0){
            echo "ok";
        }else{
            $sql = "select user_id from users where name = ?";
            $record = simpleQuery($sql,1, [$username]);
            if(count($record) > 0){
                echo "Username da ton tai";
            }else{
                $sql = "select user_id from users where email = ?";
                $record = simpleQuery($sql,1, [$email]);
                if(count($record) > 0){
                    echo "Email da ton tai";
                }else{
                    echo "Loi k xac dinh";
                }
            }
        }
    }



    $errors = array();
    if(isset($_POST['res-btn'])){
        if(empty($_POST['res-username'])){
            array_push($errors, "Khong duoc de trong username");
        }else if(empty($_POST['res-password'])){
            array_push($errors, "Khong duoc de trong password");
        }else if(empty($_POST['res-email'])){
            array_push($errors, "Khong duoc de trong email");

        }else if($_POST['res-password'] != $_POST['res-password-confirm']){
            array_push($errors, "Nhap lai password bi sai");
        }else{
            //k co loi nao
            
            $sql = "select user_id from users where name = ? and email = ?";
            $username = htmlentities($_POST["res-username"]);
            $username = trim($username);
            $password = $_POST["res-password"];
            $password = password_hash($password, PASSWORD_DEFAULT);
            $email = $_POST["res-email"];
            $record = simpleQuery($sql,1, [$username, $email]);
            if(count($record) == 0){
                $sql = "insert into users set name = ?, password = ?, email = ?";
                simpleQuery($sql,0,[$username,$password,$email]);
                
                
                $sql = "select user_id, password, role from users where name = ?";
                $record2 = simpleQuery($sql, 1, [$username]);
                hLogin($username, $record2[0]['user_id'],$record2[0]['role']);
                $sql = "insert into user_info set user_id = ?, img = ?";
                $img = "./userImages/user-default-img.png";
                simpleQuery($sql, 0, [$record2[0]['user_id'], $img]);
                echo "ok";
            }
            
        
            
            
            
        }
        if(count($errors) > 0){
            echo "error";
        }
        
    }
    
    
?>