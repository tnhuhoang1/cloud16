<?php
    require_once("../database/database-function.php"); 
    if(isset($_POST['add-category'])){
        if(empty($_POST['cate_title'])){
            echo "empty";
        }else{
            $sql = "select cate_id from categoris where title = ?";
            $record = simpleQuery($sql, 1, [$_POST['cate_title']]);
            if(count($record) == 0){
                $sql = "insert into categoris set title = ?";
                simpleQuery($sql,0,[$_POST['cate_title']]);
                echo "ok";
            }else{
                echo "invalid";
            }
        }
    }
    if(isset($_POST['add_sub_cate'])){
        if(empty($_POST['title'])){
            echo "error";
        }else{
            $sql = "select sub_cate_id from sub_categoris where title = ? and cate_id = ?";
            $record = simpleQuery($sql, 1, [$_POST['title'], $_POST['cate_id']]);
            if(count($record) == 0){
                $sql = "insert into sub_categoris set title = ?, cate_id = ?";
                simpleQuery($sql,0,[$_POST['title'], $_POST['cate_id']]);
                echo "ok";
            }else{
                echo "Da ton tai danh muc con nay";
            }
        }
    }
    if(isset($_POST['del-category'])){
        if(empty($_POST['cate_id'])){
            echo "error";
        }else{
            $sql = "delete from categoris where cate_id = ?";
            simpleQuery($sql,0,[$_POST['cate_id']]);
            echo "ok";
        }
    }
    if(isset($_POST['update-category'])){
        if(empty($_POST['cate_id'])){
            echo "error";
        }else{
            $sql = "update categoris set title = ? where cate_id = ?";
            $txt = htmlspecialchars($_POST['title']);
            simpleQuery($sql,0,[$txt,$_POST['cate_id']]);
            echo "ok";
        }
    }
    if(isset($_POST['update-sub'])){
        if(empty($_POST['sub_cate_id'])){
            echo "error";
        }else{
            $sql = "update sub_categoris set title = ? where sub_cate_id = ?";
            $txt = htmlspecialchars($_POST['title']);
            simpleQuery($sql,0,[$_POST['title'],$_POST['sub_cate_id']]);
            echo "ok";
        }
    }
    if(isset($_POST['delete-sub'])){
            $sql = "delete from sub_categoris where sub_cate_id = ?";
            simpleQuery($sql,0,[$_POST['sub_cate_id']]);
            echo "ok";
    }
    if(isset($_POST["get-cate-title"])){
        $sql = "select title from categoris where cate_id = ?";
        $record = simpleQuery($sql, 1, [$_POST['cate_id']]);
        echo $record[0]['title'];
    }

    
?>