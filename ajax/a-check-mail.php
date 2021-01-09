<?php
    require_once("../database/database-function.php");
 
    if(isset($_POST['u_email'])){
        $ok = 1;
        $sql = "select user_id from users where email = ?";
        $mail = simpleQuery($sql, 1, [$_POST['u_email']]);
        if(count($mail) > 0){
            if($mail[0]['user_id'] == $_POST['u_id']){

            }else{
                $ok = 0;
                echo "Da ton tai email nay";
            }
        }
        if($ok == 1){
            
            $sql = "update user_info set real_name = ?, gender = ?, birth = ? where user_id = ?";
            simpleQuery($sql, 0 , [$_POST['u_name'], $_POST['u_gender'], $_POST['u_birth'], $_POST['u_id']]);
            $sql = "update users set email = ? where user_id = ?";
            simpleQuery($sql, 0 , [$_POST['u_email'], $_POST['u_id']]);
            echo "ok";
            
        }
    }

?>