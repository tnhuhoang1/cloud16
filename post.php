<?php
    session_start();
    require_once("./admin/database-function.php");
    $category = null;
    if(!isset($_GET['cate_id']) || !isset($_GET['sub_cate_id']) || !isset($_GET['ar_id'])){
        header("location: index.php");
        
    }else{
        $sql = "select * from article where article_id = ?";
        $article = simpleQuery($sql, 1, [$_GET['ar_id']]);
        if(count($article) <= 0){
            header("location: index.php");
        }
    }
    $sql = "select c.title as cate_title, s.title as sub_title, a.title as a_title, create_at, content, img, a.view as view_count, article_id, s.cate_id, s.sub_cate_id from category as c, sub_category as s, article as a where s.cate_id = c.cate_id and a.sub_cate_id = s.sub_cate_id and a.article_id = ?";
    $record = simpleQuery($sql, 1, [$_GET['ar_id']]);
    if(isset($_SESSION['article'][$_GET['ar_id']])){
        $old = $_SESSION['article'][$_GET['ar_id']];
        $new = date_create();
        $diff = date_diff($old, $new);
        if($diff -> days == 0 && $diff -> h == 0 && $diff -> i > 5){
            $sql = "update article set article.view = ? where article_id = ?";
            $view = $record[0]['view_count'] + 1;
            simpleQuery($sql, 0, [$view, $_GET['ar_id']]);
            $_SESSION['article'][$_GET['ar_id']]= $new;
        }
        
    }else{
        date_default_timezone_set("Asia/Bangkok");
        $date = date_create();
        $_SESSION['article'][$_GET['ar_id']]= $date;
        $sql = "update article set article.view = ? where article_id = ?";
        $view = $record[0]['view_count'] + 1;
        simpleQuery($sql, 0, [$view, $_GET['ar_id']]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khoa Cong Nghe Thong Tin TLU</title>

    <!-- Font -->
    <?php
        include("includes/fonts.php")
    ?> 
    <!-- //font -->

    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/9b1d6678e4.js" crossorigin="anonymous"></script>
    <!-- //font awesome -->
    <!-- CSS only -->
    <!-- boostrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- //boostrap CDN -->

    <!-- my css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/posts.css">
    <!-- //my scc -->



    <!-- JS, Popper.js, and jQuery -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body>
    <!-- facebook plugin -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0" nonce="ZZpvebDi"></script>
    <!-- facebook plugin -->
    <div class="container-fluid">
        <div class="row">
            <?php include("includes/header.php") ?>
            
        </div>
        <div class= "row">
            
        </div>
        <!-- main post -->
        <div class="row">
            
        </div>
        <div class="row h-main">
            <div class="container-fluid bg-light h-con-main">
                <div class="row">
                    
                    <div class="col-sm-8 h-main-content h-main-card">
                        <div class="h-p-content">
                            <h4><?php  echo $record[0]['a_title']; ?></h4>
                            <div class="h-p-content-main">
                                <?php 
                                $content = htmlspecialchars_decode($record[0]['content']);
                                echo $content ?>
                            </div>
                        </div>
                        <div class="h-p-related-post">
                            <h5>Cac tin khac</h5>
                            <div>
                                <ul>
                                    <?php
                                        $sql = "select * from article where sub_cate_id = ? and article_id != ? order by view desc limit 5";
                                        $article = simpleQuery($sql, 1, [$_GET['sub_cate_id'], $_GET['ar_id']]);
                                        foreach($article as $v){
                                            echo '<li class="h-li h-li-dark"><a href="post.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'&ar_id='.$v['article_id'].'" class="h-a">'.$v['title'].'</a></li>';
                                        }
                                    ?>
                                    
                                    
                                </ul>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="col-sm-4 h-right-sidebar h-main-card">
                        <div class="h-ps-sub-nav">
                            <div>
                                <a href="posts.php" class="h-a"><?php  echo $record[0]['cate_title']; ?></a>
                            </div>
                            <ul>
                                <?php
                                    $sql = "select * from sub_category where cate_id = ?";
                                    $subCate = simpleQuery($sql, 1, [$_GET['cate_id']]);
                                    foreach($subCate as $v){
                                        if($v['sub_cate_id'] == $_GET['sub_cate_id']){
                                            echo '<li class="h-li"><a class="h-a h-active" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'"><i class="fas fa-chevron-right"></i>'.$v['title'].'</a></li>';
                                        }else{
                                            echo '<li class="h-li"><a class="h-a" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'"><i class="fas fa-chevron-right"></i>'.$v['title'].'</a></li>';
                                        }
                                    }
                                ?>
                                
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            
            
            
        </div>
        <!-- //main post -->
        
        <!-- footer -->
        <?php include("includes/footer.php") ?>
        <!-- //footer -->
    </div>
    




    <!-- my js -->
    <script src="js/scripts.js"></script>
    <!-- //my js -->

    <!-- slick carousel -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <!-- // slick carousel -->
</body>


</html>