<?php
    require_once("../database/database-function.php");
    if(isset($_POST['a_editUser'])){
        $sql = "select role from users where user_id = ?";
        $user = simpleQuery($sql,1, [$_POST['u_id']]);
        if($user[0]['role'] == 1){
            echo '<option value="0">Thanh vien</option>    
            <option value="1" selected>Admin</option>';
        }else{
            echo '<option value="0" selected>Thanh vien</option>    
            <option value="1">Admin</option>';
        }
    }
?>