<?php
    session_start();
    require_once("./admin/database-function.php");
    $category = null;
    if(!isset($_GET['cate_id'])){
        header("location: index.php");
        
    }else{
        $sql = "select * from category where cate_id = ?";
        $category = simpleQuery($sql, 1, [$_GET['cate_id']]);
        if(count($category) <= 0){
            header("location: index.php");
        }
    }
    $currentPage = 1;
    if(isset($_GET['s'])){
        $currentPage = $_GET['s'];
    }
    $maxPost = 8;
    $startPage = ($currentPage - 1) * $maxPost;
    
   
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
                        <h3><?php echo $category[0]['title'] ?></h3>
                        <?php
                            if(!isset($_GET['sub_cate_id'])){
                                $sql = "select * from sub_category where cate_id = ? order by sub_cate_id limit 1";
                                $subCate = simpleQuery($sql, 1, [$_GET['cate_id']]);
                                if(count($subCate) > 0){
                                    $sql = "select * from article where sub_cate_id = ? order by article_id desc limit $startPage, $maxPost";
                                    $article = simpleQuery($sql, 1, [$subCate[0]['sub_cate_id']]);
                                    $sql = "select * from article where sub_cate_id = ?";
                                    $totalArticle = simpleQuery($sql, 1, [$subCate[0]['sub_cate_id']]);
                                    if(count($article) > 0){
                                        foreach($article as $v){
                                            echo '<div class="h-ps-con">';
                                                if($v['img'] !=""){
                                                    echo '<div class="h-ps-img">
                                                        <img src="admin/'.$v['img'].'" alt="">
                                                    </div>';
                                                    echo '<div class="h-ps-detailed">';
                                                }else{
                                                    echo '<div class="h-ps-detailed" style="width:100%;">';
                                                }
                                                echo '<div class="h-ps-title"><a class="h-a" href="post.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'&ar_id='.$v['article_id'].'">'.$v['title'].'</a></div>
                                                    <div class="h-ps-des">'.$v['description'].'</div>
                                                </div>
                                            </div>';
                                        }
                                        $totalPage = intdiv(count($totalArticle), $maxPost);
                                        if(count($totalArticle) - ($maxPost * $totalPage) > 0){
                                            $totalPage++;
                                        }
                                        echo '<nav aria-label="...">
                                            <ul class="pagination">';
                                            if($totalPage > 1){
                                                if(isset($_GET['s'])){
                                                    if($_GET['s'] == 1){
                                                        echo '<li class="page-item disabled">
                                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                        </li>';
                                                    }else{
                                                        $prev = $_GET['s'] - 1;
                                                        echo '<li class="page-item">
                                                            <a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s='.$prev.'" tabindex="-1" aria-disabled="true">Previous</a>
                                                        </li>';
                                                    }
                                                    
                                                    for($i = 1 ; $i <= $totalPage; $i++){
                                                        if($i== $_GET['s']){
                                                            echo '<li class="page-item active"><a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s='.$i.'">'.$i.'</a></li>';
                                                        }else{
                                                            echo '<li class="page-item"><a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s='.$i.'">'.$i.'</a></li>';
                                                        }
                                                    }
                                                    if($_GET['s'] == $totalPage){
                                                        echo '<li class="page-item disabled">
                                                            <a class="page-link" href="#">Next</a>
                                                        </li>';
                                                    }else{
                                                        $next = $_GET['s'] + 1;
                                                        echo '<li class="page-item">
                                                            <a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s='.$next.'">Next</a>
                                                        </li>';
                                                    }
                                                    
                                                }else{
                                                    echo '<li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>';
                                                    
                                                    for($i = 1 ; $i <= $totalPage; $i++){
                                                        if($i== 1){
                                                            echo '<li class="page-item active"><a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s='.$i.'">'.$i.'</a></li>';
                                                        }else{
                                                            echo '<li class="page-item"><a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s='.$i.'">'.$i.'</a></li>';
                                                        }
                                                    }
                                                    
                                                    echo '<li class="page-item">
                                                        <a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s=2">Next</a>
                                                    </li>';
                                                }
                                                
                                            }else{
                                                echo '<li class="page-item disabled">
                                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>';
                                            }
                                            
                                            echo '</ul>
                                        </nav>';
                                        
                                    }else{
                                        echo '<div style="width: 100%; text-align:center">
                                                Chua co bai dang nao
                                            </div>';
                                    }
                                }
                            }else{
                                $sql = "select * from sub_category where sub_cate_id = ?";
                                $subCate = simpleQuery($sql, 1, [$_GET['sub_cate_id']]);
                                if(count($subCate) > 0){
                                    $sql = "select * from article where sub_cate_id = ? order by article_id desc limit $startPage, $maxPost";
                                    $article = simpleQuery($sql, 1, [$subCate[0]['sub_cate_id']]);
                                    $sql = "select * from article where sub_cate_id = ?";
                                    $totalArticle = simpleQuery($sql, 1, [$subCate[0]['sub_cate_id']]);
                                    if(count($article) > 0){
                                        foreach($article as $v){
                                            echo '<div class="h-ps-con">';
                                                if($v['img'] !=""){
                                                    echo '<div class="h-ps-img">
                                                        <img src="admin/'.$v['img'].'" alt="">
                                                    </div>';
                                                    echo '<div class="h-ps-detailed">';
                                                }else{
                                                    echo '<div class="h-ps-detailed" style="width:100%;">';
                                                }
                                                echo '<div class="h-ps-title"><a class="h-a h-a-post" href="post.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'&ar_id='.$v['article_id'].'">'.$v['title'].'</a></div>
                                                    <div class="h-ps-des">'.$v['description'].'</div>
                                                </div>
                                            </div>';
                                        }
                                        $totalPage = intdiv(count($totalArticle), $maxPost);
                                        if(count($totalArticle) - ($maxPost * $totalPage) > 0){
                                            $totalPage++;
                                        }
                                        echo '<nav aria-label="...">
                                            <ul class="pagination">';
                                            if($totalPage > 1){
                                                if(isset($_GET['s'])){
                                                    if($_GET['s'] == 1){
                                                        echo '<li class="page-item disabled">
                                                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                        </li>';
                                                    }else{
                                                        $prev = $_GET['s'] - 1;
                                                        echo '<li class="page-item">
                                                            <a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s='.$prev.'" tabindex="-1" aria-disabled="true">Previous</a>
                                                        </li>';
                                                    }
                                                    
                                                    for($i = 1 ; $i <= $totalPage; $i++){
                                                        if($i== $_GET['s']){
                                                            echo '<li class="page-item active"><a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s='.$i.'">'.$i.'</a></li>';
                                                        }else{
                                                            echo '<li class="page-item"><a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s='.$i.'">'.$i.'</a></li>';
                                                        }
                                                    }
                                                    if($_GET['s'] == $totalPage){
                                                        echo '<li class="page-item disabled">
                                                            <a class="page-link" href="#">Next</a>
                                                        </li>';
                                                    }else{
                                                        $next = $_GET['s'] + 1;
                                                        echo '<li class="page-item">
                                                            <a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s='.$next.'">Next</a>
                                                        </li>';
                                                    }
                                                    
                                                }else{
                                                    echo '<li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                    </li>';
                                                    
                                                    for($i = 1 ; $i <= $totalPage; $i++){
                                                        if($i== 1){
                                                            echo '<li class="page-item active"><a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s='.$i.'">'.$i.'</a></li>';
                                                        }else{
                                                            echo '<li class="page-item"><a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s='.$i.'">'.$i.'</a></li>';
                                                        }
                                                    }
                                                    
                                                    echo '<li class="page-item">
                                                        <a class="page-link" href="posts.php?cate_id='.$_GET['cate_id'].'&sub_cate_id='.$_GET['sub_cate_id'].'&s=2">Next</a>
                                                    </li>';
                                                }
                                                
                                            }else{
                                                echo '<li class="page-item disabled">
                                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>';
                                            }
                                            
                                            echo '</ul>
                                        </nav>';
                                        
                                    }else{
                                        echo '<div style="width: 100%; text-align:center">
                                                Chua co bai dang nao
                                            </div>';
                                    }
                                }
                            }
                        ?>
                             
                    </div>
                    <div class="col-sm-4 h-right-sidebar h-main-card">
                        <div class="h-ps-sub-nav">
                            <div>
                                <a href="posts.php?cate_id=<?php echo $category[0]['cate_id']; ?>" class="h-a"><?php echo $category[0]['title'] ?></a>
                            </div>
                            <ul>
                                <?php
                                    $sql = "select * from sub_category where cate_id =?";
                                    $subCate = simpleQuery($sql, 1, [$_GET['cate_id']]);
                                    if(isset($_GET['sub_cate_id'])){
                                        foreach($subCate as $v){
                                            if($v['sub_cate_id'] == $_GET['sub_cate_id']){
                                                echo '<li class="h-li"><a class="h-a h-active" href="posts.php?cate_id='.$category[0]['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'"><i class="fas fa-chevron-right"></i>'.$v['title'].'</a></li>';
                                            }else{
                                                echo '<li class="h-li"><a class="h-a" href="posts.php?cate_id='.$category[0]['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'"><i class="fas fa-chevron-right"></i>'.$v['title'].'</a></li>';
                                            }
                                        }
                                    }else{
                                        $i = 1;
                                        foreach($subCate as $v){
                                            if($i == 1){
                                                echo '<li class="h-li"><a class="h-a h-active" href="posts.php?cate_id='.$category[0]['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'"><i class="fas fa-chevron-right"></i>'.$v['title'].'</a></li>';
                                            }else{
                                                echo '<li class="h-li"><a class="h-a" href="posts.php?cate_id='.$category[0]['cate_id'].'&sub_cate_id='.$v['sub_cate_id'].'"><i class="fas fa-chevron-right"></i>'.$v['title'].'</a></li>';
                                            }
                                            $i++;
                                            
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