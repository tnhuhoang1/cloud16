<?php
    require_once("function.php");
    if(isset($_POST['content'])){
        $content = $_POST['content'];
        $user_id = $_POST['user_id'];
        $article_id = $_POST['article_id'];
        $sql = "insert into comments set content = ?, user_id = ?, article_id = ?";
        // $result = simpleQuery($sql, 0, [$content, $user_id, $article_id]);
        echo $_POST;
        echo "ok";
    }else{
        echo "Error";
    }

?>
