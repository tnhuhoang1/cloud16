<?php
require_once("../database/database-function.php"); 
function loadSubCate($cate_id){
    $sql = "select sub_cate_id, title from sub_categoris where cate_id = ?";
    $record = simpleQuery($sql, 1, [$cate_id]);
    if(count($record) == 0){
        echo '<div class="h-a-c-empty">
        K co danh muc con
    </div>';
    }else{
        $i = 1;
        foreach($record as $v){
            echo '<div class="h-a-c-content">
            <div class="h-a-c-row1">'. 
                $i
            .'</div>
            <div class="h-a-c-row2">
                <input type="text" class="h-sub-text" id="h-sub-title" value="'.$v['title'].'" oninput="changeSubCate(this)">
            </div>
            
            <div class="h-a-c-row4">
                <a data-id = "'.$v['sub_cate_id'].'" href="#" onclick = "deleteSub(this)"><i class="fas fa-trash-alt"></i></a>    
            </div>
            
            <div class="h-a-c-row5">
                <a class="subcate_update" data-id = "'.$v['sub_cate_id'].'" href="#" onclick = "updateSub(this)"><i class="fas fa-check"></i></a>
            </div>
        </div>';
            $i++;
        }
    }
    
    
}
if(isset($_POST['reload-sub'])){
    loadSubCate($_POST['cate_id']);
}
?>