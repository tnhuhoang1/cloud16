<?php
    session_start();
    require("database/database-function.php");
    $_SESSION['path'] = 'article';
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $viewNow = date_format(date_create(), 'Y-m-d H:i:s');
    if(isset($_POST['c_detail_sub']) && isset($_GET['article_id'])){
        if($_POST['editorComment'] == ""){
            
        }else{
            $sql = "insert into comments set detail = ?, article_id = ?, user_id = ?";
            $detail  = htmlspecialchars($_POST['editorComment']);
            simpleQuery($sql, 0 , [$detail, $_GET['article_id'], $_SESSION['user_id']]);
            header("location: forum-article.php?article_id=$_GET[article_id]");

        }
    }
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
                                <div class="container-fluid">
                                    <div class="h-t-c-dis h-ar-t-c-dis">
                                        <div class="row">
                                        <!--  -->
                                        <?php
                                            if(isset($_GET['article_id'])){
                                                $sql = "select title, description, body, create_at, sub_cate_id, user_id, view_count from articles where article_id = ? limit 1";
                                                $article = simpleQuery($sql, 1, [$_GET['article_id']]);
                                                if(count($article) > 0){
                                                    if(isset($_SESSION['view_article']["article".$_GET['article_id']])){
                                                        $lastView = date_create($_SESSION['view_article']["article".$_GET['article_id']]);
                                                        $nowView = date_create($viewNow);
                                                        $diff = date_diff($nowView, $lastView);
                                                        
                                                        if($diff -> h == 0 && $diff -> i <= 10){

                                                        }else{
                                                            $_SESSION['view_article']["article".$_GET['article_id']] = $viewNow;
                                                            $sql = "update articles set view_count = ? where article_id = ?";
                                                            simpleQuery($sql, 0, [$article[0]['view_count'] + 1,$_GET['article_id']]);
                                                        }
                                                        
                                                    }else{
                                                        $_SESSION['view_article'] = array();
                                                        $_SESSION['view_article']["article".$_GET['article_id']] = $viewNow;
                                                        $sql = "update articles set view_count = ? where article_id = ?";
                                                        simpleQuery($sql, 0, [$article[0]['view_count'] + 1, $_GET['article_id']]);
                                                        
                                                    }
                                                }
                                                
                                               
                                                $sql = "select img from user_info where user_id = ?";
                                                $info = simpleQuery($sql , 1, [$article[0]['user_id']]);                               
                                                echo '<div class="col-12 h-ar-post-wrapper">
                                                    <div class="h-ar-post-header">
                                                        <div class="h-ar-post-header1">
                                                            <img src="'.$info[0]['img'].'" alt="" class="h-user-detailed-img">
                                                        </div>
                                                        <div class="h-ar-post-header2">
                                                            <div>
                                                                <a href="forum-sub-category.php?sub_id='.$article[0]['sub_cate_id'].'" class="badge badge-primary h-badge">';
                                                                $sql = "select title from sub_categoris where sub_cate_id = ? limit 1";
                                                                $subCategory = simpleQuery($sql, 1, [$article[0]['sub_cate_id']]);
                                                                echo $subCategory[0]['title'];
                                                                echo '</a>
                                                            </div>';
                                                                $sql = "select name, create_at from users where user_id = ? limit 1";
                                                                $user = simpleQuery($sql, 1, [$article[0]['user_id']]);
                                                                $body = htmlspecialchars_decode($article[0]['body']);
                                                                $createAt = date_create($article[0]['create_at']);
                                                                $createAt = date_format($createAt, 'd-m-Y H:i:s');
                                                                $userDate = date_format(date_create($user[0]['create_at']),'d-m-Y');

                                                            echo '<p>'.$user[0]['name'].'</p>
                                                            <p>Ngày tham gia: '.$userDate.'</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="h-ar-post-content">';
                                                        if(isset($_SESSION['role'])){
                                                            if($_SESSION['role'] == 1){
                                                                echo ' <div class="h-t-c-options">
                                                                <div class="dropdown">
                                                                    <i class="fas fa-ellipsis-h" id="dropdownArticleOption" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownArticleOption">
                                                                        <a class="dropdown-item" href="#" onclick="adDeleteArticle('.$_GET['article_id'].')">Xóa câu hỏi</a>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>';
                                                            }
                                                        }
                                                        echo '<h5>'.$article[0]['title'].'</h5>
                                                        <p>'.$createAt.'</p>    
                                                        <div>'.$article[0]['description'].'</div>
                                                        <div class="h-article-body">'.$body.'</div>
                                                        <div>
                                                            <div>';
                                                                $sql = "select user_id from like_action where article_id = ?";
                                                                $like = simpleQuery($sql, 1, [$_GET['article_id']]);
                                                                if(isset($_SESSION['username'])){
                                                                    $sql = "select count(user_id) as sl from like_action where article_id = ? and user_id = ?";
                                                                    $isLike = simpleQuery($sql, 1, [$_GET['article_id'],$_SESSION['user_id']]);
                                                                    echo '<a href="#" class="h-a" onclick="return onLikeClick(this,'.$_GET['article_id'].','.$_SESSION['user_id'].')"><span>';
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
                                                                    Thích</a>'; 
                                                                    }else{
                                                                        echo '</span> <i class="fa-thumbs-up on fas"></i>
                                                                Thích</a>';
                                                                    }
                                                                }else{
                                                                    echo '</span> <i class="far fa-thumbs-up"></i>
                                                                Thích</a>';
                                                                }
                                                                
                                                            
                                                                if(isset($_SESSION['user_id'])){
                                                                    echo '<span role="button" style="margin-left: 20px" data-toggle="modal" data-target="#forumSearchModal" class="h-a"><i class="far fa-comments"></i> Trả lời</span>';
                                                                }else{
                                                                    echo '<span role="button" style="margin-left: 20px" data-toggle="modal" data-target="#replyModal" class="h-a"><i class="far fa-comments"></i> Trả lời</span>';
                                                                }
                                                                
                                                                
                                                               
                                                            echo '</div>
                                                            <div>';
                                                            $sql = "select count(user_id) as sl from comments where article_id = ?";
                                                            $comment = simpleQuery($sql, 1, [$_GET['article_id']]);
                                                            echo $comment[0]['sl'].' bình luận';
                                                            echo '</div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>';
                                            }
                                            
                                        ?>
                                            
                                        <!--  -->
                                        </div>
                                        <div class="row h-row-comment">
                                        <?php
                                            if(isset($_GET['article_id'])){
                                                $sql = "select content, detail, user_id, create_at,comment_id from comments where article_id = ?";
                                                $record = simpleQuery($sql, 1, [$_GET['article_id']]);
                                                foreach($record as $v){
                                                    $sql = "select name, create_at from users where user_id = ?";
                                                    $user = simpleQuery($sql, 1, [$v['user_id']]);
                                                    $userDate = date_format(date_create($user[0]['create_at']),'d/m/Y');
                                                    $comDate = date_format(date_create($v['create_at']),'d/m/Y H-i-s');
                                                    $sql = "select img from user_info where user_id = ?";
                                                    $info = simpleQuery($sql, 1, [$v['user_id']]);
                                                    echo '<div class="col-12 h-ar-post-comment">
                                                    <div class="h-ar-post-c-header">
                                                        <div class="h-ar-post-c-header1">
                                                            <img src="'.$info[0]['img'].'" alt="" class="h-user-detailed-img">
                                                        </div>
                                                        <div class="h-ar-post-c-header2">
    
                                                            <p class="h-ar-p-c-username"><a href="forum-information.php?user_id='.$v['user_id'].'" class="h-a">'.$user[0]['name'].'</a></p>
                                                            <p class="h-ar-p-c-date">Ngày tham gia: '.$userDate.'</p>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="h-ar-post-c-content">';
                                                        if(isset($_SESSION['role'])){
                                                            if($_SESSION['role'] == 1){
                                                                echo '<i class="fas fa-minus h-delete-comment" onclick="adDeleteComment('.$v['comment_id'].',true,'.$_GET['article_id'].')"></i>';
                                                            }
                                                        }
                                                        
                                                        echo '<p class="h-ar-p-c-date h-ar-p-c-datetime">'.$comDate.'</p>    
                                                        <div>'.$v['content'].'</div>';
                                                        if($v['detail'] != ""){
                                                            $detail = htmlspecialchars_decode($v['detail']);
                                                            echo '<div>'.$detail.'</div>';
                                                        }
                                                        
                                                    echo '</div>
                                                    
                                                </div>';


                                                }
                                            }
                                        ?>
                                            
                                            
                                            
                                        </div>
                                        <div class="row h-t-c-c">
                                        

                                            <!-- <a href="" class="h-a"><i class="far fa-thumbs-up"></i>
                                            <i class="fas fa-thumbs-up"></i>Thích</a>
                                            <span role="button" data-toggle="modal" data-target="#replyModal" class="h-a"><i class="far fa-comments"></i> Tra Loi</span> -->
                                            <!-- Modal -->
                                            <div class="modal fade" id="forumSearchModal" data-backdrop="true" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        
                                                        <div class="modal-body">
                                                            <form action="forum-article.php?article_id=<?php echo $_GET['article_id'] ?>" method="POST">
                                                                <textarea name="editorComment" id="editorComment">

                                                                </textarea>
                                                                <div class="h-btn-comment-submit">
                                                                    <input type="submit" name="c_detail_sub" value="Tra loi">
                                                                </div>
                                                            </form>

                                                            
                                                                
                                                                
                                                                
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div> 
                                            <!-- //modal -->
                                        </div>
                                        <div class="row">
                                        
                                            

                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
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
    <script>
        ClassicEditor
         .create( document.querySelector( '#editorComment' ), {
             ckfinder: {
                 uploadUrl: '/www/preject/CSE485_1851061587_TranNhuHoang/3.PROJECT/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
             },
             
             toolbar: ['imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
         }
         
         
         )
         .catch( function( error ) {
             console.error( error );
         } );

        function changeSubCate(it){
            var cate_id = it.value;
            var xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    document.getElementById("ar_sub_cate_id").innerHTML = this.responseText;
                }

            }
            xml.open("GET", "ajax/a-create-quest.php?load_sub_cate=&cate_id="+cate_id);
            xml.send();
        }
    </script>
    <script src="js/forum.js"></script>
</body>
</html>