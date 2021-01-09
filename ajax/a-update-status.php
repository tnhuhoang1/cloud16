<?php
    if(isset($_POST['online'])){
        require_once("../database/database-function.php");
        $sql = "update user_info set last_online = now() where user_id = ?";
        simpleQuery($sql,0, [$_POST['u_id']]);
    
    }

?>