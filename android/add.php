<?php
    require_once("function.php");
    if(isset($_GET['cate'])){
        $sql = "select cate_id, title from categoris";
        $cate = simpleQuery($sql);
        $result = [];
        foreach($cate as $v){
            $a['cate_id'] = $v['cate_id'];
            $a['title'] = $v['title'];
            array_push($result, $a);
        }
        echo json_encode($result);
        
    }else if(isset($_GET['cate_id'])){
        $sql = "select sub_cate_id, title from sub_categoris where cate_id = ?";
        $cate = simpleQuery($sql, 1, [$_GET['cate_id']]);
        $result = [];
        foreach($cate as $v){
            $a['sub_cate_id'] = $v['sub_cate_id'];
            $a['title'] = $v['title'];
            array_push($result, $a);
        }
        echo json_encode($result);
        
    }else if(isset($_POST['user_id'])){
        $user_id = $_POST['user_id'];
        $title = $_POST['title'];
        $des = $_POST['des'];
        $sub_cate_id = $_POST['sub_cate_id'];
        $sql = "insert into articles set title =?, des = ?, user_id = ?, sub_cate_id = ?";
        simpleQuery($sql, 0 , [$title, $des, $user_id, $sub_cate_id]);
        echo "ok";
    }else{
        echo "Error";
    }

?>