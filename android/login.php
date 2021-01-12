<?php
    require_once("function.php");
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "select name, password, role from users where name = ?";
        $user = simpleQuery($sql, 1, [$username]);
        $users = array();
        if(count($user) > 0){
            if(password_verify($password, $user[0]['password'])){
                $u["username"] = $username;
                $u['password'] = $password;
                $u['role'] = $user[0]['role'];
                array_push($users, $u);
                echo json_encode($users);

            }else{
                echo json_encode($users);
            }
        }else{
            echo json_encode($users);
        }
        
    }else{
        echo "Loi dang nhap";
    }

?>