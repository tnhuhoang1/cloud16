<?php
    require_once("../database/database-function.php"); 

    function loadArticle2(){
        echo '<div class="h-a-c-title">
        <div class="h-a-c-row1">
            STT
        </div>
        <div class="h-a-c-row2">
            Tieu de
        </div>
        <div class="h-a-c-row3">
            Nguoi dang
        </div>
        <div class="h-a-c-row4">
            Duyet
        </div>
            
        <div class="h-a-c-row5">
            Huy bai
        </div>
    </div>';
        $sql = "select article_id, title, user_id from articles where is_publish = 1";
        $article = simpleQuery($sql);
        if(count($article) == 0){
            echo '<div class="h-a-c-content" style="justify-content:center;">K co bai viet nao cho duyet</div>';
        }else{
            $i = 1;
            foreach($article as $v){
                $sql = "select name from users where user_id = ?";
                $user = simpleQuery($sql, 1, [$v['user_id']]);
                echo '<div class="h-a-c-content">
                <div class="h-a-c-row1">
                    '.$i.'
                </div>
                <div class="h-a-c-row2">
                    <a target="_blank" href="../../forum-article.php?article_id='.$v['article_id'].'" class="h-a">'.$v['title'].'</a>
                </div>
                <div class="h-a-c-row3">
                    '.$user[0]['name'].'
                </div>
                <div class="h-a-c-row4">
                    <a href="#" onclick="return adEditArticle('.$v['article_id'].')"><i class="fas fa-check-double"></i></a>    
                </div>
                    
                <div class="h-a-c-row5">
                    <a href="#" onclick="return adDeleteArticle('.$v['article_id'].')"><i class="fas fa-trash"></i></i></a>
                </div>
            </div>';
                $i++;
            }
            
        }
    }



    if(isset($_POST['a_delete'])){
        $sql = "delete from articles where article_id = ? and is_publish = 1";
        simpleQuery($sql,0,[$_POST['a_id']]);
        loadArticle2();
    }else if(isset($_POST['a_edit'])){
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = date_format(date_create(), 'Y-m-d H:i:s');
        $sql = "update articles set is_publish = 0, publish_date = ?, id_duyet = ? where article_id = ?";
        simpleQuery($sql,0,[$now,$_POST['uid'], $_POST['a_id']]);
        loadArticle2();
    }else if(isset($_POST['f_delete'])){
        $sql = "delete from comments where article_id = ?";
        simpleQuery($sql,0,[$_POST['a_id']]);
        $sql = "delete from like_action where article_id = ?";
        simpleQuery($sql,0,[$_POST['a_id']]);
        $sql = "delete from articles where article_id = ? and is_publish = 0";
        simpleQuery($sql,0,[$_POST['a_id']]);
    }else if(isset($_POST['f_delComment'])){
        $sql = "delete from comments where comment_id = ?";
        simpleQuery($sql,0,[$_POST['a_id']]);
        
    }
?>