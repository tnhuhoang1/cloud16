<?php
    require_once("function.php");
    if(isset($_GET['article_id'])){
        $sql = "select user_id, detail, content from comments where article_id = ?";
        $comment = simpleQuery($sql, 1, [$_GET['article_id']]);
        $result = [];
        foreach($comment as $v){
            $sql = "select u.name, i.img from users as u, user_info as i where u.user_id = i.user_id and u.user_id = ?";
            $user = simpleQuery($sql, 1, [$v['user_id']]);
            $a = [];
            $a['user_name'] = $user[0]['name'];
            $a['user_img'] = $user[0]['img'];
            if($v['content'] == null){
                $a['comment_content'] = "";
            }else{
                $a['comment_content'] = $v['content'];
            }
            if($v['detail'] == null){
                $a['comment_content'] = "";
            }else{
                $a['detail'] = htmlentities($v['detail']);
            }
            array_push($result, $a);
        }
        
        
        echo json_encode($result);
        
    }else{
        echo "Error";
    }

?>