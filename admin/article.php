<?php
    session_start();
    if(!isset($_SESSION['cse-username']) || !isset($_SESSION['cse-role'])){
        header("location: ../index.php");
    }
    require_once("./database-function.php");
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>

    <!-- Font -->
    <?php
        include("../includes/fonts.php")
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
    <link rel="stylesheet" href="./css/style.css">
    <!-- //my scc -->



    <!-- JS, Popper.js, and jQuery -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body class="bg-dark">
    <div class="container-fluid main-container">
        <div class="row">
            <?php
                include_once("admin-nav.php");
            ?>
        </div>
        <div class="row h-row-main">
            <div class="h-main-content">
                <?php
                if(isset($_SESSION['errors'])){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>'.$_SESSION['errors'].'</strong> 
                    </div>';
                    unset($_SESSION['errors']);
                }
                
                ?>
                
                <div style="border-bottom: 1px solid gray;">
                    <h4>Quan li bai viet</h4>
                </div>
                <div>
                    <button class="h-btn h-btn-adduser" data-toggle="modal" data-target="#userModal"><a href="add-article.php" style=" color:green;">Them bai viet</a></button>
                </div>
                <div class="h-flex-verticle h-user-title">
                    <div>STT</div>
                    <div>Tieu de</div>
                    <div>Thuoc</div>
                    <div>Sua</div>
                    <div>Xoa</div>

                </div>
                
                    <?php
                        $sql = "select * from article";
                        $article = simpleQuery($sql);
                        $i = 1;
                        foreach($article as $v){
                            
                            echo '<div class="h-flex-verticle h-user-content">
                            <div>'.$i.'</div>
                            <div><a class="h-a-dark" href="add-slide.php?ar_id='.$v['article_id'].'">'.$v['title'].'</a></div>';
                            $sql = "select title from sub_category where sub_cate_id = ?";
                            $subCate = simpleQuery($sql, 1, [$v['sub_cate_id']]);
                            echo '<div>'.$subCate[0]['title'].'</div>
                            <div><i class="fas fa-edit" onclick="adEditArticle()"></i></div>';
                            echo '<div><i class="fas fa-trash" onclick="adDeleteArticle('.$v['article_id'].')"></i></div>';
                            echo '</div>';
                            $i++;
                        }
                    ?>
                    
                
            
                <!-- <div class="" data-toggle="buttons">
                    <div>
                        <label class="btn btn-primary active">
                            <input type="checkbox" name="" id="" checked autocomplete="off">
                        </label>
                    </div>
                    <div>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="" id="" autocomplete="off">
                        </label>
                    </div>
                    <div>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="" id="" autocomplete="off">
                        </label>
                    </div>
                    
                </div> -->
            </div>
        </div>
    </div>
    
    




    

<script src="js/js.js"></script>
</body>


</html>