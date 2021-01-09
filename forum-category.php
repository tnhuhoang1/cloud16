<?php
    session_start();
    require("database/database-function.php");
    $_SESSION['path'] = 'category';
?>
<!DOCTYPE html>
<html lang="en">
<?php
//head
include("forum/head.php");
?>
<body class="bg-light">
    <div class="container-fluid h-main-container">
        <!-- logo nav-->
        <?php
            include("forum/logo.php");
            // banner
            include("forum/banner.php");
        ?>
        <!-- //logo nav -->
        
        <div class="row h-main-row bg-light" >
            <div class="container h-main-con">
                <?php
                    //nav
                    include("forum/navbar.php");
                ?>
                <div class="row h-secondary-row">
                    <div class="container-fluid h-topics-content-title">
                        <div class="row">
                            <div class="col-sm-8">
                                
                                <div class="container-fluid">
                                <!-- du phong -->
                                    
                                </div>
                                <div class="container-fluid h-cate-main">
                                    <div class="row h-cate-header">
                                        <div class="col-5">Ten muc</div>
                                        <div class="col-2" style="text-align:center">Bai dang</div>
                                        <div class="col-5">Bai dang cuoi</div>
                                    </div>
                                    <?php
                                        if(isset($_GET['c_id'])){
                                            $sql = "select cate_id, title from categoris where cate_id = ?";
                                            $record = simpleQuery($sql,1,[$_GET['c_id']]);
                                            foreach($record as $v){
                                                echo '<div class="h-cate-cate">
                                                    <div class="row h-cate-title">
                                                        <a href="forum-sub-category.php?c_id='.$v['cate_id'].'" class="h-a">'.$v['title'].'</a>
                                                    </div>';
                                                    $sql = "select sub_cate_id, title from sub_categoris where cate_id = ?";
                                                    $record2 = simpleQuery($sql,1,[$v['cate_id']]);
                                                    foreach($record2 as $v2){
                                                        echo '<div class="row h-cate-topics">
                                                            <div class="col-5"><a class ="h-a"  href="forum-sub-category.php?sub_id='.$v2['sub_cate_id'].'" ><i class="fas fa-bullhorn"></i>'.$v2['title'].'</a></div>
                                                            <div class="col-2" style="text-align: center;">';
                                                            $sql = "select title, user_id, create_at, article_id from articles where sub_cate_id = ? and is_publish = 0 order by article_id desc";
                                                            $article= simpleQuery($sql, 1, [$v2['sub_cate_id']]);
                                                            echo count($article);
                                                            echo '</div>
                                                            <div class="col-5 h-cate-last-post">
                                                                <div class="h-c-l-p-con">';
                                                                    
                                                                    if(count($article) > 0){
                                                                        $sql = "select img from user_info where user_id = ?";
                                                                        $info = simpleQuery($sql, 1, [$article[0]['user_id']]);
                                                                        $sql = "select name from users where user_id = ?";
                                                                        $user = simpleQuery($sql, 1, [$article[0]['user_id']]);
                                                                        $articleDate = date_format(date_create($article[0]['create_at']), "d/m/Y - H:i:s");
                                                                        echo '<div class="h-c-t-img">
                                                                            <img src="'.$info[0]['img'].'" alt="" data-toggle="tooltip" data-placement="bottom" title="'.$user[0]['name'].'">
                                                                            
                                                                        </div>
                                                                        <div class="h-c-t-detaled">
                                                                            <p class="h-p-topics-title"><a href="forum-article.php?article_id='.$article[0]['article_id'].'" class="h-a">'.$article[0]['title'].'</a></p>
                                                                            <p class="h-p-topics-date">'.$articleDate.'</p>
                                                                        </div>';
                                                                    }else{
                                                                        echo '<div class="h-empty-ar" style="width: 100%; text-align:center; font-size: 0.8em">Chua co bai dang gan nhat</div>';
                                                                    }
                                                                    
                                                                echo '</div>

                                                            </div>
                                                        </div>';
                                                    }
                                                echo '</div>';
                                        }
                                        }else{
                                            $sql = "select cate_id, title from categoris";
                                            $record = simpleQuery($sql);
                                            foreach($record as $v){
                                            echo '<div class="h-cate-cate">
                                                <div class="row h-cate-title">
                                                    <a href="forum-sub-category.php?c_id='.$v['cate_id'].'" class="h-a">'.$v['title'].'</a>
                                                </div>';
                                                $sql = "select sub_cate_id, title from sub_categoris where cate_id = ?";
                                                $record2 = simpleQuery($sql,1,[$v['cate_id']]);
                                                foreach($record2 as $v2){
                                                    echo '<div class="row h-cate-topics">
                                                        <div class="col-5"><a class ="h-a"  href="forum-sub-category.php?sub_id='.$v2['sub_cate_id'].'" ><i class="fas fa-bullhorn"></i>'.$v2['title'].'</a></div>
                                                        <div class="col-2" style="text-align: center;">';
                                                        $sql = "select title, user_id, create_at, article_id from articles where sub_cate_id = ? and is_publish = 0 order by article_id desc";
                                                        $article= simpleQuery($sql, 1, [$v2['sub_cate_id']]);
                                                        echo count($article);
                                                        echo '</div>
                                                        <div class="col-5 h-cate-last-post">
                                                            <div class="h-c-l-p-con">';
                                                                
                                                                if(count($article) > 0){
                                                                    $sql = "select img from user_info where user_id = ?";
                                                                    $info = simpleQuery($sql, 1, [$article[0]['user_id']]);
                                                                    $sql = "select name from users where user_id = ?";
                                                                    $user = simpleQuery($sql, 1, [$article[0]['user_id']]);
                                                                    $articleDate = date_format(date_create($article[0]['create_at']), "d/m/Y - H:i:s");
                                                                    echo '<div class="h-c-t-img">
                                                                        <img src="'.$info[0]['img'].'" alt="" data-toggle="tooltip" data-placement="bottom" title="'.$user[0]['name'].'">
                                                                        
                                                                    </div>
                                                                    <div class="h-c-t-detaled">
                                                                        <p class="h-p-topics-title"><a href="forum-article.php?article_id='.$article[0]['article_id'].'" class="h-a">'.$article[0]['title'].'</a></p>
                                                                        <p class="h-p-topics-date">'.$articleDate.'</p>
                                                                    </div>';
                                                                }else{
                                                                    echo '<div class="h-empty-ar" style="width: 100%; text-align:center; font-size: 0.8em">Chua co bai dang gan nhat</div>';
                                                                }
                                                                
                                                            echo '</div>

                                                        </div>
                                                    </div>';
                                                }
                                            echo '</div>';
                                    }
                                        }
                                        

                                    ?>


                                    

                                    
                                    
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="h-side-bar">
                                    <?php
                                    // most asked
                                    include("forum/most-asked.php");
                                    ?>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>

        </div>
    </div>

    <script src="js/forum.js"></script>
</body>
</html>