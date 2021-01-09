<?php
    session_start();
    $_SESSION['path'] = 'quest';
    require_once("path.php");
    require_once(PATH."./database/database-function.php");
?>
<?php
    if(isset($_POST["ar-submit"])){
        if($_POST['ar-title'] == "" || $_POST['ar_sub_cate_id'] == ""){

        }else{
            if(isset($_SESSION["username"])){
                $body = htmlspecialchars($_POST['ar-body-content']);
                if($body == ""){
                    $sql = "insert into articles set title = ?, description = ?, body = ?, sub_cate_id = ? , user_id = ?";
                    simpleQuery($sql,0,[$_POST['ar-title'], $_POST['ar-des'], $body,$_POST['ar_sub_cate_id'], $_SESSION['user_id']]);
                    header("location: forum.php");
                }else{
                    $sql = "insert into articles set title = ?, description = ?, body = ?, sub_cate_id = ? , user_id = ?, is_publish = ?";
                    if($_SESSION['role'] == 1){
                        simpleQuery($sql,0,[$_POST['ar-title'], $_POST['ar-des'], $body,$_POST['ar_sub_cate_id'], $_SESSION['user_id'], 0]);
                    }else{
                        simpleQuery($sql,0,[$_POST['ar-title'], $_POST['ar-des'], $body,$_POST['ar_sub_cate_id'], $_SESSION['user_id'], 1]);
                        $_SESSION['waiting'] = 1;
                    }
                    
                    header("location: forum.php");
                }
                
            }

            
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<?php
//head
include(PATH."/forum/head.php");
?>
<body class="bg-light">
    <div class="h-full-alert" id="h-full-alert">
        <div>
        
        </div>
    </div>
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
                <div class="row h-cr-row">
                    <div class="col-12">
                        <div><h1>Tao moi cau hoi</h1></div>
                        <form action="forum-create-quest.php" method="POST">
                            <div class="h-cr-title">
                                <input type="text" name="ar-title" required placeholder="Tieu de (khong duoc de trong)">
                            </div>
                            <div class="h-cr-des">
                                <input type="text" name="ar-des" placeholder="Mo ta so qua ve cau hoi (co the bo trong)">
                            </div> 
                            <div class="h-cr-select">
                                <span>Danh muc</span>
                                <select name="ar_cate_id" oninput="changeSubCate(this)">
                                    <?php
                                        $sql = "select cate_id, title from categoris";
                                        $record = simpleQuery($sql);
                                        $i = 0;
                                        $selectedCate = 0;
                                        foreach($record as $v){
                                            if($i == 0){
                                                echo '<option value="'.$v['cate_id'].'" selected>'.$v['title'].'</option>';
                                                $selectedCate = $v['cate_id'];
                                            }else{
                                                echo '<option value="'.$v['cate_id'].'">'.$v['title'].'</option>';
                                            }
                                            $i++;
                                        }

                                    ?>
                                    
                                </select>
                                <span>Danh muc con</span>
                                <select name="ar_sub_cate_id" id="ar_sub_cate_id">
                                    <?php
                                        
                                        $sql = "select sub_cate_id, title from sub_categoris where cate_id = ?";
                                        $record = simpleQuery($sql, 1, [$selectedCate]);
                                        if(count($record) == 0){
                                            echo '<option value="" selected></option>';
                                        }else{
                                            $i = 0;
                                            $selectedCate = 0;
                                            foreach($record as $v){
                                                if($i == 0){
                                                    echo '<option value="'.$v['sub_cate_id'].'" selected>'.$v['title'].'</option>';
                                                    $selectedCate = $v['cate_id'];
                                                }else{
                                                    echo '<option value="'.$v['sub_cate_id'].'">'.$v['title'].'</option>';
                                                }
                                                $i++;
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="h-cr-body">
                                <textarea name="ar-body-content" id="editor1" cols="30" rows="10" placeholder="Mo ta chi tiet ve cau hoi (co the bo trong)">


                                </textarea>
                            </div>
                            <div class="h-cr-submit">
                                <button type="submit" name="ar-submit">Dang</button>
                            </div>
                                
                        </form>
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
         .create( document.querySelector( '#editor1' ), {
             ckfinder: {
                 uploadUrl: '/www/preject/CSE485_1851061587_TranNhuHoang/3.PROJECT/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
             },
             
             toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
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