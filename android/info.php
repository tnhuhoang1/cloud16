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
        
    }else if(isset($_POST['real_name'])){
        $realName = $_POST['real_name'];
        $birth = $_POST['birth'];
        $birth = date_format(date_create($birth),'Y-m-d');
        $gender = $_POST['gender'];
        $user_id = $_POST['user_id'];
        if(strtolower($gender) == "nam"){
            $gender = 1;
        }else{
            $gender = 0;
        }
        $sql = "update user_info set real_name = ?, birth = ?, gender = ? where user_id = ?";
        simpleQuery($sql, 0, [$realName, $birth, $gender, $user_id]);
        echo "ok";
    }
    else{
        echo "Error";
    }

?>