<?php
    require_once("../database/database-function.php");
    if(isset($_POST['quick_comment'])){
        if($_POST['content'] != ""){
            $sql = "insert into comments set content = ?, user_id = ?, article_id = ?";
            simpleQuery($sql, 0, [$_POST['content'],$_POST['user_id'],$_POST['article_id']]);
            $sql = "select content, user_id,detail, comment_id from comments where article_id = ? order by create_at asc";
            $record = simpleQuery($sql,1,[$_POST['article_id']]);
            $sql = "select name from users where user_id = ?";
            foreach($record as $com){
                $detail = htmlspecialchars_decode($com['detail']);
                $user = simpleQuery($sql, 1, [$com['user_id']]);
                $sqls = "select img from user_info where user_id = ?";
                $info = simpleQuery($sqls, 1, [$com['user_id']]);
                echo '<div>
                    <div class="h-comment-log-user">
                        <img src="'.$info[0]['img'].'" alt="" class="img-fluid h-user-img-comment"><a href="forum-information.php?user_id='.$com['user_id'].'" class="h-a"> '.$user[0]['name'].'</a>
                    </div>
                    <div class="h-c-l-comment">
                        <i class="fas fa-minus h-delete-comment" onclick="adDeleteComment('.$com['comment_id'].',false)"></i>
                        '.$com['content'].$detail.'
                    </div>
                </div>';
            }
            
        }
    } 
  
?>