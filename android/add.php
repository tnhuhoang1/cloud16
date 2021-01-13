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
        $sql = "select cate_id, title from sub_categoris where cate_id = ?";
        $cate = simpleQuery($sql, 1, [$_GET['cate_id']]);
        $result = [];
        foreach($cate as $v){
            $a['sub_cate_id'] = $v['cate_id'];
            $a['title'] = $v['title'];
            array_push($result, $a);
        }
        echo json_encode($result);
        
    }else{
        echo "Error";
    }

?>