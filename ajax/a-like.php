<?php
    require_once("../database/database-function.php");
    if(isset($_POST['like_action'])){
        
        $sql = "insert into like_action set user_id = ?, article_id = ?";
        simpleQuery($sql, 0, [$_POST['user_id'],$_POST['article_id']]);
        $sql = "select count(user_id) as sl from like_action where article_id = ?";
        $sl = simpleQuery($sql, 1, [$_POST['article_id']]);
        echo $sl[0]['sl'];
    }else if(isset($_POST['unlike_action'])){
        $sql = "delete from like_action where user_id = ? and article_id = ?";
        simpleQuery($sql, 0, [$_POST['user_id'],$_POST['article_id']]);
        $sql = "select count(user_id) as sl from like_action where article_id = ?";
        $sl = simpleQuery($sql, 1, [$_POST['article_id']]);
        echo $sl[0]['sl'];
    }
    

?>