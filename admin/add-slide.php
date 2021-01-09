<?php
    session_start();
    if(!isset($_SESSION['cse-username']) || !isset($_SESSION['cse-role'])){
        header("location: ../index.php");
    }
    require_once("./database-function.php");
    require_once("./upload-file.php");
    $errors = array();
    if(!isset($_GET['ar_id'])){
        header("location: ../index.php");
    }else{
        $sql = "select article_id from slide where article_id = ?";
        $slide = simpleQuery($sql,1, [$_GET['ar_id']]);
        if(count($slide) > 0){
            $_SESSION['errors'] = "Da co slide nay roi";
            // header("location: ./article.php");
        }
    }
    if(isset($_POST['addSlide'])){
        
        $upload = "";
        
        if($_FILES['img']['name'] != ''){
            $upload = uploadFile($_FILES['img'], "uploads/");
            if($upload == "error"){
                array_push($errors, "Loi tai anh");
            }else{
                $sql = "select article_id from slide where article_id = ?";
                $slide = simpleQuery($sql,1, [$_GET['ar_id']]);
                if(count($slide) == 0){
                    $sql = "select * from article where article_id = ?";
                    $article = simpleQuery($sql, 1, [$_GET['ar_id']]);
                    $sql = "insert into slide set title = ? , alt_url = ?, article_id = ?, img = ?";
                    simpleQuery($sql, 0, [$article[0]['title'],$_POST['link'],$article[0]['article_id'], $upload]);
                    $_SESSION['errors'] = "Them slide thanh cong";
                    header("location: ./article.php");
                }else{
                    $_SESSION['errors'] = "Da co slide nay roi";
                }
                
            }
        }else{
            $_SESSION['errors'] = "K de trong anh";
        }
            
        
    }
    if(count($errors) > 0){
        $_SESSION['errors'] = $errors[0];
    }

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

    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
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
                    <h4>Them slide</h4>
                </div>
                <div>
                    <form action="add-slide.php?ar_id=<?php echo $_GET['ar_id']; ?>" method="POST" id="adArticle" enctype="multipart/form-data">
                    
                        <div>
                            <input type="file" name="img" id="articleImg">
                        </div>
                        <div>
                            <input type="text" name="link" placeholder="link du phong">
                        </div>
                            
                        <div>
                            <button type="submit" name="addSlide">Them slide</button>
                        </div>
                    </form>
                </div>
                    
                    
                
                
               
                
            </div>
        </div>
    </div>
    
    




    

<script>
    
</script>  

<script src="js/js.js"></script> 
</body>




</html>