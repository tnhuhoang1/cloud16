<?php
    require_once("function.php");
    if(isset($_POST['username'])){
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
        
    }else{
        echo "Loi dang ki";
    }

?>