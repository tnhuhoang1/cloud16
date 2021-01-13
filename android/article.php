<?php
    require_once("function.php");
    if(isset($_GET['user_id'])){
        $sql = "select article_id, title, description, body, sub_cate_id, user_id from articles where article_id = ?";
        $article = simpleQuery($sql, 1, [$_GET['article_id']]);
        $sql = "select u.name, i.img from users as u, user_info as i where u.user_id = i.user_id and u.user_id = ?";
        $user = simpleQuery($sql, 1, [$article[0]['user_id']]);
        $sql = "select c.title as cateTitle, s.title as subTitle from categoris as c, sub_categoris as s where c.cate_id = s.cate_id and s.sub_cate_id = ?";
        $title = simpleQuery($sql, 1, [$article[0]['sub_cate_id']]);
        $sql = "select count(user_id) as sl from like_action where article_id = ?";
        $likeCount = simpleQuery($sql, 1, [$article[0]['article_id']]);
        $sql = "select count(user_id) as sl from comments where article_id =?";
        $commentCount = simpleQuery($sql, 1, [$article[0]['article_id']]);

        $sql = "select * from like_action where user_id = ? and article_id = ?";
        $isLike = simpleQuery($sql, 1, [$_GET['user_id'], $_GET['article_id']]);
        if(count($isLike) > 0){
            $isLike = "true";
        }else{
            $isLike = "false";
        }

        $result = [];
        $a['article_id'] = $article[0]['article_id'];
        $a['user_id'] = $article[0]['user_id'];
        $a['sub_cate_id'] = $article[0]['sub_cate_id'];
        $a['article_title'] = $article[0]['title'];
        $a['article_description'] = $article[0]['description'];
        $a['article_body'] = $article[0]['body'];
        $a['user_name'] = $user[0]['name'];
        $a['user_img'] = $user[0]['img'];
        $a['cate_title'] = $title[0]['cateTitle'];
        $a['sub_title'] = $title[0]['subTitle'];
        $a['like_count'] = $likeCount[0]['sl'];
        $a['comment_count'] = $commentCount[0]['sl'];  
        $a['is_like'] = $isLike;  
        array_push($result, $a);
        echo json_encode($result);
        
    }else if(isset($_GET['article_id'])){
        $sql = "select article_id, title, description, body, sub_cate_id, user_id from articles where article_id = ?";
        $article = simpleQuery($sql, 1, [$_GET['article_id']]);
        $sql = "select u.name, i.img from users as u, user_info as i where u.user_id = i.user_id and u.user_id = ?";
        $user = simpleQuery($sql, 1, [$article[0]['user_id']]);
        $sql = "select c.title as cateTitle, s.title as subTitle from categoris as c, sub_categoris as s where c.cate_id = s.cate_id and s.sub_cate_id = ?";
        $title = simpleQuery($sql, 1, [$article[0]['sub_cate_id']]);
        $sql = "select count(user_id) as sl from like_action where article_id = ?";
        $likeCount = simpleQuery($sql, 1, [$article[0]['article_id']]);
        $sql = "select count(user_id) as sl from comments where article_id =?";
        $commentCount = simpleQuery($sql, 1, [$article[0]['article_id']]);

        $result = [];
        $a['article_id'] = $article[0]['article_id'];
        $a['user_id'] = $article[0]['user_id'];
        $a['sub_cate_id'] = $article[0]['sub_cate_id'];
        $a['article_title'] = $article[0]['title'];
        $a['article_description'] = $article[0]['description'];
        $a['article_body'] = $article[0]['body'];
        $a['user_name'] = $user[0]['name'];
        $a['user_img'] = $user[0]['img'];
        $a['cate_title'] = $title[0]['cateTitle'];
        $a['sub_title'] = $title[0]['subTitle'];
        $a['like_count'] = $likeCount[0]['sl'];
        $a['comment_count'] = $commentCount[0]['sl'];  
        array_push($result, $a);
        echo json_encode($result);
        
    }else{
        echo "Error";
    }

?>