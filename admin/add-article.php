<?php
    session_start();
    if(!isset($_SESSION['cse-username']) || !isset($_SESSION['cse-role'])){
        header("location: ../index.php");
    }
    require_once("./database-function.php");
    require_once("./upload-file.php");
    $errors = array();
    if(isset($_POST['addArticle'])){
        if($_POST['articleTitle'] == ""){
            array_push($errors, "K de trong ten bai viet");
        }else if($_POST['articleBody'] == ""){
            array_push($errors, "K de trong noi dung bai viet");
        }else if($_POST['adCateList'] == 0){
            array_push($errors, "Phai chon danh muc");
        }else if($_POST['adSubCateList'] == 0){
            array_push($errors, "Phai chon danh muc con");
        }
        else{
            $upload = "";
            if($_FILES['articleImg']['name'] != ''){
                $upload = uploadFile($_FILES['articleImg'], "uploads/");
                if($upload == "error"){
                    array_push($errors, "Loi tai anh");
                }else{
                    $sql = "insert into article set title = ? , description = ?, content = ?, sub_cate_id = ?, img = ?";
                    $content = htmlspecialchars($_POST['articleBody']);
                    simpleQuery($sql, 0, [$_POST['articleTitle'],$_POST['articleDes'],$content,$_POST['adSubCateList'], $upload]);
                    $_SESSION['errors'] = "Dang bai thanh cong";
                }
            }else{
                $sql = "insert into article set title = ? , description = ?, content = ?, sub_cate_id = ?, img = ?";
                $content = htmlspecialchars($_POST['articleBody']);
                simpleQuery($sql, 0, [$_POST['articleTitle'],$_POST['articleDes'],$content,$_POST['adSubCateList'], $upload]);
                $_SESSION['errors'] = "Dang bai thanh cong";
            }
            
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
                    <h4>Them bai viet</h4>
                </div>
                <div>
                    <form action="" method="POST" id="adArticle" enctype="multipart/form-data">
                        <div>
                            <input type="text" name="articleTitle" placeholder="Ten bai viet">
                        </div>
                        <div>
                            <input type="text" name="articleDes" placeholder="Mo ta bai viet">
                        </div>
                        <div>
                            <input type="file" name="articleImg" id="articleImg">
                        </div>
                        <div>
                            <div>
                                <select name="adCateList" id="adCateList" onchange="changeCate(this)">
                                    <?php
                                        $sql = "select * from category";
                                        $cate = simpleQuery($sql);
                                        $i = 1;
                                        foreach($cate as $v){
                                            if($i == 1){
                                                echo '<option value="0" selected>--- select ---</option>';
                                                echo '<option value="'.$v['cate_id'].'">'.$v['title'].'</option>';
                                            }else{
                                                echo '<option value="'.$v['cate_id'].'">'.$v['title'].'</option>';
                                            }
                                            $i++;
                                            
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                            <div>
                                <select name="adSubCateList" id="adSubCateList">
                                    <?php
                                        echo '<option value="0" selected>--- select ---</option>';
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div>
                            <textarea name="articleBody" id="editorAddArticle" cols="30" rows="10">

                            </textarea>
                        </div>
                        <div>
                            <button type="submit" name="addArticle">Them bai viet</button>
                        </div>
                    </form>
                </div>
                    
                    
                
                
               
                
            </div>
        </div>
    </div>
    
    




    

<script>
    let addArticleEditor;
    ClassicEditor
        .create( document.querySelector( '#editorAddArticle' ), {
            ckfinder: {
                uploadUrl: '/www/preject/CSE485_1851061587_TranNhuHoang/3.PROJECT/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            },
            
            toolbar: ['imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
        }
        
        
        ).then(newEditor =>{
            addArticleEditor = newEditor;
        })
        .catch( function( error ) {
            console.error( error );
        } );
    // function dd(){
    //     alert(addArticleEditor.setData("ddd"));
    //     return false;
    // }
    // function changeSubCate(it){
    //     var cate_id = it.value;
    //     var xml = new XMLHttpRequest();
    //     xml.onreadystatechange = function(){
    //         if(this.readyState == 4 && this.status == 200){
    //             document.getElementById("ar_sub_cate_id").innerHTML = this.responseText;
    //         }

    //     }
    //     xml.open("GET", "ajax/a-create-quest.php?load_sub_cate=&cate_id="+cate_id);
    //     xml.send();
    // }
</script>  

<script src="js/js.js"></script> 
</body>


</html>