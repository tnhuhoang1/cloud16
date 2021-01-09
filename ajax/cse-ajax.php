<?php
    session_start();
    require_once("../admin/database-function.php");
    if(isset($_POST['loadShotcutPost'])){
        //$sql = "select c.title as cate_title, s.title as sub_title, a.title as a_title, create_at, content, img, a.view as view_count, article_id, s.cate_id, s.sub_cate_id from category as c, sub_category as s, article as a where s.cate_id = c.cate_id and a.sub_cate_id = s.sub_cate_id and a.article_id = ?";
        $sql = "select * from article where article_id = ?";
        $record = simpleQuery($sql, 1, [$_POST['ar_id']]);
        $arr1 = array();
        array_push($arr1, ['title' => $record[0]['title']]);
        array_push($arr1, ["img" => $record[0]['img']]);
        array_push($arr1, ["content" => htmlspecialchars_decode($record[0]['content'])]);
        // array_push($arr, "hoang");
        $json = json_encode($arr1);
        echo $json;

    }else if(isset($_POST['cseSearch'])){
        if(isset($_SESSION['recentSearch'])){
            // unset($_SESSION['recentSearch'][2]);
            foreach($_SESSION['recentSearch'] as $k => $v){
                if($v == $_POST['key']){
                    unset($_SESSION['recentSearch'][$k]);
                }
            }
            if(count($_SESSION['recentSearch']) >= 10){
                array_pop($_SESSION['recentSearch']);
            }
            array_unshift($_SESSION['recentSearch'], $_POST['key']);
            
            
            $sql = "select * from article where title like '%$_POST[key]%' limit 5";
            $article = simpleQuery($sql);
            $data = array();
            $found = array();
            if(count($article) > 0){
                foreach($article as $v){
                    $sql = "select * from sub_category where sub_cate_id = ?";
                    $subCate = simpleQuery($sql, 1, [$v['sub_cate_id']]);
                    $s = "";
                    $s= $s.'<div><a class="h-a" href="post.php?cate_id='.$subCate[0]['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'&ar_id='.$v['article_id'].'">';
                        if($v['img'] != ""){
                            $s= $s.'<img src="admin/'.$v['img'].'" class="img-fluid h-search-img" alt="">';
                        }    
                    
                        $s= $s.'<h5>'.$v['title'].'</h5></a></div>';
                    array_push($found, $s);
                }
                
            }else{
                $s= '<div class="h-s-r-not-found"><p class="h-s-text">K tim thay ket qua</p></div>';
                array_push($found, $s);
            }
            $recent = array();
            foreach($_SESSION['recentSearch'] as $v){
                array_unshift($recent, $v);
            }
            array_push($data, $found);
            array_push($data, $recent);
            echo json_encode($data);
            // var_dump($_SESSION['recentSearch']);
        }else{
            $_SESSION['recentSearch'] = array();
            array_push($_SESSION['recentSearch'], $_POST['key']);
            $sql = "select * from article where title like '%$_POST[key]%' limit 5";
            $article = simpleQuery($sql);
            $data = array();
            $found = array();
            if(count($article) > 0){
                foreach($article as $v){
                    $sql = "select * from sub_category where sub_cate_id = ?";
                    $subCate = simpleQuery($sql, 1, [$v['sub_cate_id']]);
                    $s = "";
                    $s= $s.'<div><a class="h-a" href="post.php?cate_id='.$subCate[0]['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'&ar_id='.$v['article_id'].'">';
                        if($v['img'] != ""){
                            $s= $s.'<img src="admin/'.$v['img'].'" class="img-fluid h-search-img" alt="">';
                        }    
                    
                        $s= $s.'<h5>'.$v['title'].'</h5></a></div>';
                    array_push($found, $s);
                }
                
            }else{
                $s= '<div class="h-s-r-not-found"><p class="h-s-text">K tim thay ket qua</p></div>';
                array_push($found, $s);
            }
            $recent = array();
            foreach($_SESSION['recentSearch'] as $v){
                array_unshift($recent, $v);
            }
            array_push($data, $found);
            array_push($data, $recent);
            echo json_encode($data);
            
        }
    }

?>