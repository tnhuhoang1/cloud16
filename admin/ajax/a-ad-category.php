<?php
    require_once("../database-function.php");

    if(isset($_POST['addCategory'])){
        $sql = "select count(title) as sl from category where title = ?";
        $cate = simpleQuery($sql, 1, [$_POST['title']]);
        if($cate[0]['sl'] > 0){
            echo 'Da ton tai ten danh muc nay roi';
        }else{
            $sql = "insert into category set title = ?";
            simpleQuery($sql,0, [$_POST['title']]);
            echo "ok";
        }
    }else if(isset($_POST['addSubCategory'])){
        $sql = "select count(title) as sl from sub_category where title = ? and cate_id = ?";
        $cate = simpleQuery($sql, 1, [$_POST['title'], $_POST['c_id']]);
        if($cate[0]['sl'] > 0){
            echo 'Da ton tai ten danh muc nay roi';
        }else{
            $sql = "insert into sub_category set title = ?, cate_id = ?";
            simpleQuery($sql, 0, [$_POST['title'], $_POST['c_id']]);
            echo "ok";
        }
    }else if(isset($_POST['deleteSubCategory'])){
        $sql = "delete from sub_category where sub_cate_id = ?";
        simpleQuery($sql, 0 , [$_POST['id']]);
        echo 'ok';
        
    }else if(isset($_POST['deleteCategory'])){
        $sql = "delete from category where cate_id = ? and level = 0";
        simpleQuery($sql, 0 , [$_POST['id']]);
        echo 'ok';   
    }else if(isset($_POST['loadCategory'])){
        $sql = "select * from category where cate_id = ?";
        $cate = simpleQuery($sql, 1 , [$_POST['id']]);
        echo json_encode($cate);   
    }else if(isset($_POST['editCategory'])){
        $sql = "select count(title) as sl from category where title = ?";
        $cate = simpleQuery($sql, 1, [$_POST['title']]);
        if($cate[0]['sl'] > 0){
            echo 'Da ton tai ten danh muc nay roi';
        }else{
            $sql = "update category set title = ? where cate_id = ?";
            simpleQuery($sql,0, [$_POST['title'], $_POST['cate_id']]);
            echo "ok";
        }
    }else if(isset($_POST['loadSubCategory'])){
        $sql = "select * from sub_category where sub_cate_id = ?";
        $subCate = simpleQuery($sql, 1 , [$_POST['id']]);
        echo '<div>
            <input type="text" placeholder="Ten danh muc" value="'.$subCate[0]['title'].'">
        </div>
        <div>
            <select id="cateListEdit">';
                $sql = "select * from category";
                $cate = simpleQuery($sql);
                foreach($cate as $v){
                    if($v['cate_id'] == $subCate[0]['cate_id']){
                        echo '<option value="'.$v['cate_id'].'" selected>'.$v['title'].'</option>';
                    }else{
                        echo '<option value="'.$v['cate_id'].'">'.$v['title'].'</option>';
                    }
                }
                
            echo '</select>
        </div>
        <div>
            <button value="'.$subCate[0]['sub_cate_id'].'">Sua</button>
        </div>';

    }else if(isset($_POST['editSubCategory'])){
        $sql = "select count(title) as sl from sub_category where title = ? and cate_id = ?";
        $cate = simpleQuery($sql, 1, [$_POST['title'], $_POST['cate_id']]);
        if($cate[0]['sl'] > 0){
            echo 'Da ton tai ten danh muc nay roi';
        }else{
            $sql = "update sub_category set title = ?, cate_id = ? where sub_cate_id = ?";
            simpleQuery($sql,0, [$_POST['title'], $_POST['cate_id'], $_POST['id']]);
            echo "ok";
        }
    }else if(isset($_POST['changeCate'])){
        $sql = "select * from sub_category where cate_id = ?";
        $subCate = simpleQuery($sql, 1, [$_POST['cate_id']]);
        if(count($subCate) == 0){
            echo '<option value="0" selected>--- select ---</option>';
        }else{
            $i = 1;
            foreach($subCate as $v){
                if($i == 1){
                    echo '<option value="'.$v['sub_cate_id'].'" selected>'.$v['title'].'</option>';
                }else{
                    echo '<option value="'.$v['sub_cate_id'].'">'.$v['title'].'</option>';
                }
                $i++;
            }
        }
    }else if(isset($_POST['adEditArticle'])){
        $sql = "delete from article where article_id = ?";
        simpleQuery($sql, 0, [$_POST['id']]);
        echo 'ok';
        
    }else if(isset($_POST['adminDelete'])){
        $sql = "select role from users where user_id = ?";
        $user = simpleQuery($sql, 1, [$_POST['id']]);
        if($user[0]['role'] == 1){
            echo "K the xoa";
        }else{
            $sql = "delete from users where user_id = ? and role = 0";
            simpleQuery($sql, 0, [$_POST['id']]);
            echo 'ok';
        }
        
        
    }

?>