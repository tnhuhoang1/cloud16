<?php
    session_start();
    require_once("./admin/database-function.php");
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
            <!-- slide show -->
            <?php include("includes/slideShow.php") ?>
        <!-- //slide show -->
        </div>
        <!-- main post -->
        <div class="row">
            
        </div>
        <div class="row bg-light h-main">
            <div class="container-fluid bg-light h-con-main">
                <div class="row">
                    
                    <div class="col-sm-3 h-left-sidebar h-main-card">
                        <div class="h-left-sidebar-top">
                            <h2 class="h-main-title">
                                Tin Tuc
                            </h2>
                            <ul>
                                <?php
                                    $sql = "select * from sub_category where cate_id = 6";
                                    $subCate = simpleQuery($sql);
                                    foreach($subCate as $v){
                                        echo '<li class="h-li h-nav-side"><a href="posts.php?cate_id=6&sub_cate_id='.$v['sub_cate_id'].'" class="h-a" >'.$v['title'].'</a></li>';
                                    }
                                ?>


                            </ul>
                        </div>
                        <div class="h-left-sidebar-bottom">
                            <h2 class="h-main-title">
                                Tin Tuc Noi Bat
                            </h2>
                            <?php
                                    $sql = "select * from article order by article.view desc limit 5";
                                    $article = simpleQuery($sql);
                                    foreach($article as $v){
                                        $sql = "select * from sub_category where sub_cate_id = ?";
                                        $subCate = simpleQuery($sql, 1, [$v['sub_cate_id']]);

                                        echo '<div class="h-sidebar-post" style="margin-bottom: 10px;">
                                            <a href="#" class="h-a" role="button" data-toggle="modal" data-target="#hSidebarModal" onclick="shotcutPost('.$subCate[0]['cate_id'].','.$v['sub_cate_id'].','.$v['article_id'].')">';
                                                if($v['img'] != ""){
                                                    echo '<div class="h-sidebar-post-img">
                                                    <img src="admin/'.$v['img'].'" class="img-fluid" style="width: 100%;" alt="">
                                                    </div>';
                                                }
                                                
                                                echo '<h3 class="h-h3-jus h-h3-new">'.$v['title'].'</h3>
                                            </a>
                                            <div class="h-sidebar-post-content">                       
                                                <a href="post.php?cate_id='.$subCate[0]['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'&ar_id='.$v['article_id'].'" class="h-a" style="font-size: 0.85em;">Xem chi tiet <i class="fas fa-greater-than"></i></a>
                                            </div>
                                            
                                        </div>';
                                    }
                            ?>
                            <!-- Modal -->
                            <div class="modal fade" id="hSidebarModal" data-backdrop="true" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hSidebarModalTitle"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="hSidebarModalContent">
                                                <!-- <img src="images/i1.jpg" class="img-fluid" alt=""> -->
                                                <p></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <!-- <button type="button" class="btn btn-primary"></button> -->
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <!-- //modal -->
                


                        </div>
                        
                        




                    </div>







                    <div class="col-sm-6 h-main-content h-main-card">
                        <h2 class="h-main-title">
                            Tin Moi Nhat
                        </h2>
                        <div class="h-main-con-post">
                            <?php
                            $sql = "select * from article order by article_id desc limit 5";
                            $article = simpleQuery($sql);
                            foreach($article as $v){
                                $sql = "select * from sub_category where sub_cate_id = ?";
                                $subCate = simpleQuery($sql, 1, [$v['sub_cate_id']]);
                                echo '<div class="h-con-post">';
                                    if($v['img'] != ""){
                                        echo '<div class="h-main-post-img">
                                            <img src="admin/'.$v['img'].'" class="img-fluid" alt="">
                                        </div>';
                                    }
                                    
                                    echo '<div class="h-post-content">
                                        <p>'.$v['create_at'].'</p>
                                        <h3 class="h-h3-jus"><a href="post.php?cate_id='.$subCate[0]['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'&ar_id='.$v['article_id'].'" class="h-a h-a-dark">'.$v['title'].'</a></h3>
                                        <p class="h-post-description h-h3-jus">
                                            '.$v['description'].'
                                        </p>
                                    </div>
                                </div>
                                <div class="h-post-break">
                                    
                                </div>';
                            }
                            
                            ?>
                            
                        </div>
                        
                        
                    </div>
                    <div class="col-sm-3 h-right-sidebar h-main-card">
                        <div>
                            <h2 class="h-main-title">
                                <?php echo '<a href="posts.php?cate_id=8" class="h-a">Thong Bao</a>'; ?>
                            </h2>
                            <?php
                                $sql = "select a.title, a.create_at, a.article_id,a.sub_cate_id from article as a, sub_category as s where a.sub_cate_id = s.sub_cate_id and s.cate_id = 8";
                                $article = simpleQuery($sql);
                                foreach($article as $v){
                                    $sql = "select * from sub_category where sub_cate_id = ?";
                                    $subCate = simpleQuery($sql, 1, [$v['sub_cate_id']]);
                                    echo '<div class="h-right-sidebar-content">
                                        <p class="h-right-sidebar-content-date">'.$v['create_at'].'</p>
                                        <h4><a href="post.php?cate_id='.$subCate[0]['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'&ar_id='.$v['article_id'].'" class="h-a h-a-dark h-h3-new">'.$v['title'].'</a></h4>
                                    </div>';
                                }
                            ?>
                            
                        </div>
                        <div class="h-forum-entrance">
                            <div class="h-forum-entrance-c1">
                                <a href="forum.php" class="h-a"><sapn><i class="fab fa-foursquare"></i></sapn>orum CSE</a>
                            </div>
                            
                        </div>
                        
                    </div>

                </div>
            </div>
            
            <!-- image nav -->
            <?php
                // include_once("./includes/img-nav.php");
            ?>
            <!-- //image nav -->
            
        </div>
        <!-- //main post -->
        <!-- forum slide show -->
        <div class="row bg-light">
            <div class="container-fluid">
                <?php
                    // include_once("./includes/event.php");
                ?>
            </div>
        </div>
        <!-- //forum slide show -->
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