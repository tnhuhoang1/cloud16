<?php
    require_once("function.php");
    if(isset($_POST['username'])){
        $sql = "select user_id from users where name = ? or email = ?";
        $username = htmlentities($_POST["username"]);
        $username = trim($username);
        $email = $_POST["email"];
        $password = $_POST['password'];
        $password = htmlentities($password);
        $record = simpleQuery($sql,1, [$username, $email]);
        if(count($record) == 0){
            $sql = "insert into users set name = ?, password = ?, email = ?";
            $password = password_hash($password, PASSWORD_DEFAULT);
            simpleQuery($sql, 0, [$username, $password, $email]);
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
        
    }else{
        echo "Loi dang ki";
    }

?>