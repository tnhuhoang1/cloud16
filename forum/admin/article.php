<?php
    session_start();
    if(isset($_SESSION['status']) && $_SESSION['role'] == 1){
    }else{
        header("location: ../../forum.php");
    }
    require_once("../../database/database-function.php");
    $_SESSION['admin-path'] = 'article';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORUM HQ</title>

    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/9b1d6678e4.js" crossorigin="anonymous"></script>
    <!-- //font awesome -->
    <!-- CSS only -->
    <!-- boostrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- //boostrap CDN -->

    <link rel="stylesheet" href="css/style.css">


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
</head>
<body>

    <!-- Modal -->
    <div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered h-modal-center">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel1">Chinh sua nguoi dung</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    
                
                </form>











            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Huy</button>
                <button type="button" class="btn btn-primary">Luu</button>
            </div>
            </div>
        </div>
    </div>




    <div class="container-fluid">
        <div class="row h-ad-logo">
        <?php
                include_once('admin-topbar.php');
            ?>
            <div class="col-9">
                <div>
                    <h4>Quan li bai viet</h4>
                </div>
            </div>
            

        </div>
        <div class="row">
            <div class="col-3 h-ad-left-sec">
                <?php
                include_once("left-nav.php");

            ?>
            </div>
            <div class="col-9 h-ad-right-sec">
                <div>
                    <div class="h-a-control">

                    </div>
                    <div class="h-a-con" id="adArticleCon">
                        <div class="h-a-c-title">
                            <div class="h-a-c-row1">
                                STT
                            </div>
                            <div class="h-a-c-row2">
                                Tieu de
                            </div>
                            <div class="h-a-c-row3">
                                Nguoi dang
                            </div>
                            <div class="h-a-c-row4">
                                Duyet
                            </div>
                                
                            <div class="h-a-c-row5">
                                Huy bai
                            </div>
                        </div>
                        <?php
                            $sql = "select article_id, title, user_id from articles where is_publish = 1";
                            $article = simpleQuery($sql);
                            if(count($article) == 0){
                                echo '<div class="h-a-c-content" style="justify-content:center;">K co bai viet nao cho duyet</div>';
                            }else{
                                $i = 1;
                                foreach($article as $v){
                                    $sql = "select name from users where user_id = ?";
                                    $user = simpleQuery($sql, 1, [$v['user_id']]);
                                    echo '<div class="h-a-c-content">
                                    <div class="h-a-c-row1">
                                        '.$i.'
                                    </div>
                                    <div class="h-a-c-row2">
                                        <a target="_blank" href="../../forum-article.php?article_id='.$v['article_id'].'" class="h-a">'.$v['title'].'</a>
                                    </div>
                                    <div class="h-a-c-row3">
                                        '.$user[0]['name'].'
                                    </div>
                                    <div class="h-a-c-row4">
                                        <a href="#" onclick="return adEditArticle('.$v['article_id'].','.$_SESSION['user_id'].')"><i class="fas fa-check-double"></i></a>    
                                    </div>
                                        
                                    <div class="h-a-c-row5">
                                        <a href="#" onclick="return adDeleteArticle('.$v['article_id'].')"><i class="fas fa-trash"></i></i></a>
                                    </div>
                                </div>';
                                    $i++;
                                }
                                
                            }
                        ?>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/js.js"></script>
</body>
</html>