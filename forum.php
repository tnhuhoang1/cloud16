<?php
    session_start();
    require_once("./database/database-function.php");
    $_SESSION['path'] = "home";
?>
<?php
    

?>
<!DOCTYPE html>
<html lang="en">
<?php
//head
include("./forum/head.php");
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
                                    <?php
                                    if(isset($_SESSION['waiting'])){
                                        if($_SESSION['waiting'] == 1){

                                        
                                            echo '<div style="margin-top: 20px;">
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Dang thanh cong!</strong> Cau hoi cua ban dang cho duyet.
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                
                                                </div>
                                            </div>';
                                        }
                                        unset($_SESSION['waiting']);
                                    }
                                    
                                    ?>
                                    <div class="h-topics-title">

                                        <div class="row">
                                            <div class="col-7">
                                                Cau hoi gan day
                                            </div>
                                            <div class="col h-t-t-t">
                                                Tra loi
                                            </div>
                                            <div class="col h-t-t-t h-t-t-t-time">
                                                Thoi gian
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                </div>
                                <div class="container-fluid">
                                    
                                    
                                       
                                    <!--  -->
                                    <?php
                                        if(isset($_GET['page'])){
                                            $start = ($_GET['page'] - 1) * $_GET['max'];
                                            $sql = "select article_id, title, sub_cate_id, user_id, create_at from articles where is_publish = 0 order by article_id desc limit ".$start.",".$_GET['max'];
                                        }else{
                                            $sql = "select article_id, title, sub_cate_id, user_id, create_at from articles where is_publish = 0 order by article_id desc limit 10";
                                        }
                                        
                                        $record = simpleQuery($sql);
                                        foreach($record as $v){
                                            $sql = "select img from user_info where user_id = ?";
                                            $info = simpleQuery($sql, 1, [$v['user_id']]);
                                            $sql = "select name from users where user_id = ?";
                                            $user = simpleQuery($sql, 1, [$v['user_id']]);
                                            echo '<div class="h-t-c-dis">';
                                            if(isset($_SESSION['role'])){
                                                if($_SESSION['role'] == 1){
                                                    echo ' <div class="h-t-c-options">
                                                    <div class="dropdown">
                                                        <i class="fas fa-ellipsis-h" id="dropdownArticleOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownArticleOption">
                                                            <a class="dropdown-item" href="#" onclick="adDeleteArticle('.$v['article_id'].')">Xoa cau hoi</a>
                                                            
                                                        </div>
                                                    </div>
                                                </div>';
                                                }
                                            }
                                           
                                            echo '<div class="row">
                                                <div class="col-7 h-col-7">';
                                                    $sql = "select cate_id, title from categoris where cate_id = (select cate_id from sub_categoris where sub_cate_id = ?)";
                                                    $cateTitle = simpleQuery($sql, 1, [$v['sub_cate_id']]);
                                                    echo '<a href="forum-information.php?user_id='.$v['user_id'].'" ><img src="'.$info[0]['img'].'" alt="" class="img-fluid h-user-img-title" data-toggle="tooltip" data-placement="bottom" title="'.$user[0]['name'].'"></a><a href="forum-category.php?c_id='.$cateTitle[0]['cate_id'].'" class="badge badge-primary h-badge">';
                                                    
                                                    echo $cateTitle[0]['title'];
                                                    echo '</a>
                                                    
                                                </div>
                                                <div class="col h-t-t-t">
                                                    <div>';
                                                $sql = "select comment_id, article_id, content,detail, user_id from comments where article_id = ? order by create_at asc";
                                                $comment = simpleQuery($sql,1,[$v['article_id']]);
                                                echo count($comment).' binh luan';
                                                echo '</div>
                                                </div>
                                                <div class="col h-t-t-t">
                                                    <div>';
                                                    $datePush = date_create($v['create_at']);
                                                    echo date_format($datePush, "d/m/Y");
                                                    
                                                    echo '</div>
                                                    
                                                </div>
                                            </div>
                                            <div>
                                                <div style="margin: 10px 0 0 0px">
                                                    <p><a href="forum-article.php?article_id='.$v['article_id'].'" class="h-a">'.$v['title'].'</a></p>
                                                </div>
                                            </div>
                                            <div class="row h-t-c-c">';
                                                $sql = "select user_id from like_action where article_id = ?";
                                                $like = simpleQuery($sql, 1, [$v["article_id"]]);
                                                if(isset($_SESSION['username'])){
                                                    $sql = "select count(user_id) as sl from like_action where article_id = ? and user_id = ?";
                                                    $isLike = simpleQuery($sql, 1, [$v["article_id"],$_SESSION['user_id']]);
                                                    echo '<a href="#" class="h-a" onclick="return onLikeClick(this,'.$v['article_id'].','.$_SESSION['user_id'].')"><span>';
                                                }else{
                                                    echo '<a href="#" class="h-a" onclick="return false" role="button" data-toggle="modal" data-target="#replyModal"><span>';
                                                }
                                                
                                                $sql = "select name from users where user_id = ?";
                                                
                                                if(count($like) != 0){
                                                    echo count($like);
                                                }
                                                if(isset($_SESSION['username'])){
                                                    if($isLike[0]['sl'] == 0){
                                                        echo '</span> <i class="far fa-thumbs-up"></i>
                                                    Thich</a>'; 
                                                    }else{
                                                        echo '</span> <i class="fa-thumbs-up on fas"></i>
                                                Thich</a>';
                                                    }
                                                }else{
                                                    echo '</span> <i class="far fa-thumbs-up"></i>
                                                Thich</a>';
                                                }
                                                
                                                
                                                    if(isset($_SESSION["username"])){
                                                        echo '<span class="h-a h-reply" onclick= "showCommentBox(this)" data-id="'.$v['article_id'].'"><i class="far fa-comments"></i> Tra Loi</span>';
                                                    }else{
                                                        echo '<span role="button" data-toggle="modal" data-target="#replyModal" class="h-a"><i class="far fa-comments"></i> Tra Loi</span>';
                                                    }
    
                                                
                                            echo '</div>
                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="h-comment-log" id="log-comment-'.$v['article_id'].'">
                                                        <div class="h-comment-log-con">';
                                                            foreach($comment as $com){
                                                                $detail = htmlspecialchars_decode($com['detail']);
                                                                $user = simpleQuery($sql, 1, [$com['user_id']]);
                                                                $sqls = "select img from user_info where user_id = ?";
                                                                $info = simpleQuery($sqls, 1, [$com['user_id']]);
                                                                echo '<div>
                                                                    <div class="h-comment-log-user">
                                                                        <img src="'.$info[0]['img'].'" alt="" class="img-fluid h-user-img-comment"><a href="forum-information.php?user_id='.$com['user_id'].'" class="h-a"> '.$user[0]['name'].'</a>
                                                                    </div>
                                                                    <div class="h-c-l-comment">';
                                                                    if(isset($_SESSION['role'])){
                                                                        if($_SESSION['role'] == 1){
                                                                            echo '<i class="fas fa-minus h-delete-comment" onclick="adDeleteComment('.$com['comment_id'].',false)"></i>';
                                                                        }
                                                                    }
                                                                    
                                                                        echo $com['content'].$detail.'
                                                                    </div>
                                                                </div>';
                                                            }
                                                            
                                                            
                                                        echo '</div>
                                                        <div class="h-comment-input">
                                                            <form action="#" method="post" class="form h-form" onsubmit="return quickComment(this,'.$v['article_id'].','.$_SESSION['user_id'].')">
                                                                
                                                                <input type="text" placeholder="your comment">
                                                                <button type="submit" class="btn"><i class="fas fa-paper-plane"></i></button>
                                                            </form>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                
    
                                            </div>
                                        </div>';
                                        }
                                    ?>

                                    
                                    <!--  -->
                                    
                                    
                                    
                                    <!-- pagination -->
                                    <?php
                                        require_once("./forum/pagination.php");
                                        if(!isset($_GET['page'])){
                                            pagination(true,1,10,"forum.php");
                                        }else{
                                            pagination(false,$_GET['page'],$_GET['max'],"forum.php");
                                            
                                        }
                                        

                                    ?>
                                    <!-- //pagination -->
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="h-side-bar">
                                    <!-- quick ask -->
                                    <!-- <div class="h-quick-ask"> -->
                                        <!-- <div class="h-q-a-title">
                                            <h4>Cau hoi nhanh</h4>
                                        </div>
                                        <div class="h-m-a-post">
                                            <h6><a href="forum-article.php" class="h-a" data-toggle="modal" data-target="#hSidebarQuickAsk">Tuyen sinh truc tuyen la nguy hiem cho tre em duoi 18 tuoi</a></h6>
                                            <p class="h-p-i">16/7/2000</p>
                                        </div> -->

                                        <!-- Modal -->
                                        <!-- <div class="modal fade" id="hSidebarQuickAsk" data-backdrop="true" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div>
                                                            <h5 class="modal-title h-a-m-title" id="staticBackdropLabel">Tuyen sinh truc tuyen la nguy hiem cho tre em duoi 18 tuoi</h5>
                                                            <p class="h-p-i">16/7/2000</p>
                                                        </div>
                                                        
                                                            
                                                        
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="h-q-comment">
                                                            <p><span>Tra loi: </span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae harum numquam eos dolores consectetur ratione quod debitis earum ab, libero quis nihil cupiditate quos impedit? Sunt soluta cum culpa sit.</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="h-comment-input">
                                                            <form action="" class="form h-form">
                                                                
                                                                <input type="text" placeholder="your comment">
                                                                <button type="submit" class="btn"><i class="fas fa-paper-plane"></i></button>
                                                            </form>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        //modal -->
                                

                                        <!-- <div class="h-m-a-post">
                                            <h6><a href="forum-article.php" class="h-a">Tuyen sinh truc tuyen la nguy hiem cho tre em duoi 18 tuoi</a></h6>
                                            <p>16/7/2000</p>
                                        </div>
                                        <div class="h-m-a-post">
                                            <h6><a href="forum-article.php" class="h-a">Tuyen sinh truc tuyen la nguy hiem cho tre em duoi 18 tuoi</a></h6>
                                            <p>16/7/2000</p>
                                        </div>
                                        <div class="h-m-a-post">
                                            <h6><a href="forum-article.php" class="h-a">Tuyen sinh truc tuyen la nguy hiem cho tre em duoi 18 tuoi</a></h6>
                                            <p>16/7/2000</p>
                                        </div>
                                    </div> -->
                                    <?php
                                    // most asked
                                    include("forum/most-asked.php");
                                    include_once("forum/stats.php");
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row h-main-row">
                    <div class="container-fluid h-topics-content-title">
                        <div class="row">
                            <div class="col-sm-8">
                                
                            </div>
                            <div class="col-sm">
                            
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