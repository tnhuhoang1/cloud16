<?php
    session_start();
    require_once('./database/database-function.php');
    $_SESSION['path'] = 'sub_cate';
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
                            <div class="col-lg-8">
                                
                                <div class="container-fluid">
                                <!-- du phong -->
                                    
                                </div>
                                <div class="container-fluid h-cate-main">
                                    <?php
                                        if(isset($_GET['sub_id'])){
                                            $sql = "select article_id, title, body,user_id, create_at, view_count from articles where sub_cate_id = ? and is_publish = 0 ";
                                            $article = simpleQuery($sql,1,[$_GET['sub_id']]);
                                            if(count($article) == 0){
                                                echo '<div class="row h-cate-header" style="text-align: center">Danh muc hien chua bai viet nao</div>';
                                            }else{
                                                echo '<div class="row h-cate-header">
                                                <div class="col-7">Tiêu đề</div>
                                                <div class="col-2" style="text-align:center">Tổng quan</div>
                                                <div class="col-3">Đăng bài</div>
                                            </div>
                                            <div class="h-cate-cate">';
                                                foreach($article as $v){
                                                    $articleDate = date_format(date_create($v['create_at']), 'd/m/Y - H:i:s');
                                                    $sql = "select name, img from users, user_info WHERE users.user_id = user_info.user_id and users.user_id = ?";
                                                    $user = simpleQuery($sql, 1, [$v['user_id']]);
                                                    $sql = "select count(user_id) as sl from comments where article_id = ?";
                                                    $slComments = simpleQuery($sql, 1, [$v['article_id']]);
                                                    $sql = "select count(user_id) as sl from like_action where article_id = ?";
                                                    $slLikes = simpleQuery($sql, 1, [$v['article_id']]);
                                                    echo '<div class="row h-cate-topics">
                                                        <div class="col-7"><a class="h-a" href="forum-article.php?article_id='.$v['article_id'].'">';
                                                        if($v['body'] == ""){
                                                            echo '<i class="fas fa-question">';
                                                        }else{
                                                            echo '<i class="fas fa-bullhorn">';
                                                        }
                                     
                                                        echo '</i>'.$v['title'].'</a></div>
                                                        <div class="col-2" style="text-align: center;">
                                                            <div class="h-sc-stats">
                                                                <p>'.$slComments[0]['sl'].' trả lời</p>
                                                                <p>'.$slLikes[0]['sl'].' like</p>
                                                                <p>'.$v['view_count'].' lượt xem</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 h-cate-last-post">
                                                            <div class="h-c-l-p-con">
                                                                <div class="h-c-t-img">
                                                                    <img src="'.$user[0]['img'].'" alt="" data-toggle="tooltip" data-placement="bottom" title="'.$user[0]['name'].'">
                                                                    
                                                                </div>
                                                                <div class="h-sc-t-detailed">
                                                                    <p class="h-sc-name"><a href="forum-information.php?user_id='.$v['user_id'].'" class="h-a">'.$user[0]['name'].'</a></p>
                                                                    <p class="h-p-topics-date">'.$articleDate.'</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>';
                                                }
                                                echo '</div>';
                                            }
                                        }else if(isset($_GET['c_id'])){
                                            $sql = "select article_id, title, body,user_id, create_at, view_count from articles where is_publish = 0 and sub_cate_id in(select sub_cate_id from sub_categoris where cate_id = ?)";
                                            $article = simpleQuery($sql,1,[$_GET['c_id']]);
                                            if(count($article) == 0){
                                                echo '<div class="row h-cate-header" style="text-align: center">Danh muc hien chua bai viet nao</div>';
                                            }else{
                                                echo '<div class="row h-cate-header">
                                                <div class="col-7">Tiêu đề</div>
                                                <div class="col-2" style="text-align:center">Tổng quan</div>
                                                <div class="col-3">Dang boi</div>
                                            </div>
                                            <div class="h-cate-cate">';
                                                foreach($article as $v){
                                                    $articleDate = date_format(date_create($v['create_at']), 'd/m/Y - H:i:s');
                                                    $sql = "select name, img from users, user_info WHERE users.user_id = user_info.user_id and users.user_id = ?";
                                                    $user = simpleQuery($sql, 1, [$v['user_id']]);
                                                    $sql = "select count(user_id) as sl from comments where article_id = ?";
                                                    $slComments = simpleQuery($sql, 1, [$v['article_id']]);
                                                    $sql = "select count(user_id) as sl from like_action where article_id = ?";
                                                    $slLikes = simpleQuery($sql, 1, [$v['article_id']]);
                                                    echo '<div class="row h-cate-topics">
                                                        <div class="col-7"><a class="h-a" href="forum-article.php?article_id='.$v['article_id'].'">';
                                                        if($v['body'] == ""){
                                                            echo '<i class="fas fa-question">';
                                                        }else{
                                                            echo '<i class="fas fa-bullhorn">';
                                                        }
                                     
                                                        echo '</i>'.$v['title'].'</a></div>
                                                        <div class="col-2" style="text-align: center;">
                                                            <div class="h-sc-stats">
                                                                <p>'.$slComments[0]['sl'].' tra loi</p>
                                                                <p>'.$slLikes[0]['sl'].' like</p>
                                                                <p>'.$v['view_count'].' luot xem</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 h-cate-last-post">
                                                            <div class="h-c-l-p-con">
                                                                <div class="h-c-t-img">
                                                                    <img src="'.$user[0]['img'].'" alt="" data-toggle="tooltip" data-placement="bottom" title="'.$user[0]['name'].'">
                                                                    
                                                                </div>
                                                                <div class="h-sc-t-detailed">
                                                                    <p class="h-sc-name"><a href="forum-information.php?user_id='.$v['user_id'].'" class="h-a">'.$user[0]['name'].'</a></p>
                                                                    <p class="h-p-topics-date">'.$articleDate.'</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>';
                                                }
                                                echo '</div>';
                                            }
                                        }else if(isset($_GET['search'])){
                                            $s = "%$_GET[search]%";
                                            $sql = "select article_id, title, body,user_id, create_at, view_count from articles where title like ?";
                                            $article = simpleQuery($sql,1,[$s]);
                                            if(count($article) == 0){
                                                echo '<div class="row h-cate-header" style="text-align: center">Khong tim kiem thay ket qua nao co tu \''.$_GET['search'].'\'</div>';
                                            }else{
                                                echo '<div class="row h-cate-header">
                                                <div class="col-7">Tieu de</div>
                                                <div class="col-2" style="text-align:center">Tong quan</div>
                                                <div class="col-3">Dang boi</div>
                                            </div>
                                            <div class="h-cate-cate">';
                                                foreach($article as $v){
                                                    $articleDate = date_format(date_create($v['create_at']), 'd/m/Y - H:i:s');
                                                    $sql = "select name, img from users, user_info WHERE users.user_id = user_info.user_id and users.user_id = ?";
                                                    $user = simpleQuery($sql, 1, [$v['user_id']]);
                                                    $sql = "select count(user_id) as sl from comments where article_id = ?";
                                                    $slComments = simpleQuery($sql, 1, [$v['article_id']]);
                                                    $sql = "select count(user_id) as sl from like_action where article_id = ?";
                                                    $slLikes = simpleQuery($sql, 1, [$v['article_id']]);
                                                    echo '<div class="row h-cate-topics">
                                                        <div class="col-7"><a class="h-a" href="forum-article.php?article_id='.$v['article_id'].'">';
                                                        if($v['body'] == ""){
                                                            echo '<i class="fas fa-question">';
                                                        }else{
                                                            echo '<i class="fas fa-bullhorn">';
                                                        }
                                     
                                                        echo '</i>'.$v['title'].'</a></div>
                                                        <div class="col-2" style="text-align: center;">
                                                            <div class="h-sc-stats">
                                                                <p>'.$slComments[0]['sl'].' tra loi</p>
                                                                <p>'.$slLikes[0]['sl'].' like</p>
                                                                <p>'.$v['view_count'].' luot xem</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-3 h-cate-last-post">
                                                            <div class="h-c-l-p-con">
                                                                <div class="h-c-t-img">
                                                                    <img src="'.$user[0]['img'].'" alt="" data-toggle="tooltip" data-placement="bottom" title="'.$user[0]['name'].'">
                                                                    
                                                                </div>
                                                                <div class="h-sc-t-detailed">
                                                                    <p class="h-sc-name"><a href="forum-information.php?user_id='.$v['user_id'].'" class="h-a">'.$user[0]['name'].'</a></p>
                                                                    <p class="h-p-topics-date">'.$articleDate.'</p>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>';
                                                }
                                                echo '</div>';
                                            } 
                                        }
                                        
                                    ?>
                                        
                
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                            <div class="col-lg">
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