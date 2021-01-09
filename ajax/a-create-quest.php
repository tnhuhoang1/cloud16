<?php
    require_once("../database/database-function.php");
    if(isset($_GET['load_sub_cate'])){
        $sql = "select sub_cate_id, title from sub_categoris where cate_id = ?";
        $record = simpleQuery($sql, 1, [$_GET['cate_id']]);
        if(count($record) == 0){
            echo '<option value="" selected></option>';
        }else{
            $i = 0;
            $selectedCate = 0;
            foreach($record as $v){
                if($i == 0){
                    echo '<option value="'.$v['sub_cate_id'].'" selected>'.$v['title'].'</option>';
                    $selectedCate = $v['cate_id'];
                }else{
                    echo '<option value="'.$v['sub_cate_id'].'">'.$v['title'].'</option>';
                }
                $i++;
            }
        }
        unset($_GET['cate_id']);
        unset($_GET['load_sub_cate']);
    }              
    
?>