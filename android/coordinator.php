<?php
    require_once("function.php");
    if(isset($_POST['get_main_posts'])){
        $posts = array();
        $sql = "select article_id, title, user_id, sub_cate_id, view_count from articles where is_publish = 0 order by article_id desc";
        $articles = simpleQuery($sql);
        foreach($articles as $v){
            $post = [];
            $sql = "select u.user_id, u.name as name, i.img as img from users as u, user_info as i where u.user_id = i.user_id and u.user_id = ?";
            $user = simpleQuery($sql, 1, [$v['user_id']]);
            $sql = "select title from sub_categoris where sub_cate_id = ?";
            $subcate = simpleQuery($sql, 1, [$v['sub_cate_id']]);

            $sql = "select count(user_id) as sl from like_action where article_id = ?";
            $likes= simpleQuery($sql, 1, [$v['article_id']]);
            
            $likeCount = 0;
            if(count($likes) > 0){
                $likeCount = $likes[0]['sl'];
            }

            $post['article_id'] = $v['article_id'];
            $post['title'] = $v['title'];
            $post['sub_cate_id'] = $v['sub_cate_id'];
            $post['sub_cate_title'] = $subcate[0]['title'];
            $post['user_id'] = $v['user_id'];
            $post['user_name'] = $user[0]['name'];
            $post['user_img'] = $user[0]['img'];
            $post['view_count'] = $v['view_count'];
            $post['like_count'] = $likeCount;
            array_push($posts, $post);
        
        }   
        echo json_encode($posts);
    }

?>