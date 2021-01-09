<?php
    require_once("../database/database-function.php");
    function loadCategory(){
        $sql = "select cate_id,title from categoris";
        $record = simpleQuery($sql);
        $i = 1;
        foreach($record as $v){
            echo '<div class="h-a-c-content">
            <div>';
                echo $i;
            echo '</div>
            <div class="h-a-c-row2">';
                echo $v['title'];
            echo '</div>
            <div class="h-a-c-row3">';
                $sql = "select sub_cate_id from sub_categoris where cate_id = ?";
                $temp = simpleQuery($sql,1,[$v['cate_id']]);
                echo count($temp);
            echo '</div>
            <div class="h-a-c-row4">
            <a href="#" role="button" data-toggle="modal" data-target="#modalEdit" data-id = "';echo $v['cate_id']; echo '" onclick="editCategory(this)"><i class="fas fa-edit"></i></a>    
            </div>
                
            <div class="h-a-c-row5">
                <a href="#" onclick = "deleteCate(this,'; echo $v['cate_id']; echo ')"><i class="fas fa-trash-alt"></i></a>
            </div>
            </div>';
            $i++;
        }
    }
    
    loadCategory();
?>