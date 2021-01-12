<?php
    require_once("function.php");
    if(isset($_GET['user_id'])){
        $sql = "select real_name, gender, birth, img from user_info where user_id = ?";
        $info = simpleQuery($sql, 1, [$_GET['user_id']]);
        $sql = "select count(article_id) as sl from articles where user_id = ?";
        $postCount = simpleQuery($sql, 1, [$_GET['user_id']]);
        $sql = "select create_at, email from users where user_id = ?";
        $user = simpleQuery($sql, 1, [$_GET['user_id']]);

        $result = array();
        $i['real_name'] = $info[0]['real_name'];
        $i['gender'] = $info[0]['gender'];
        $i['birth'] = date_format(date_create($info[0]['birth']),'d-m-Y');
        $i['join'] =  date_format(date_create($user[0]['create_at']),'d-m-Y');
        $i['email'] = $user[0]['email'];
        $i['post_count'] = $postCount[0]['sl'];
        $i['user_img'] = $info[0]['img'];
        array_push($result, $i);
        echo json_encode($result);
        
    }else{
        echo "Error";
    }

?>