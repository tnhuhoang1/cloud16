<?php
    session_start();
    $_SESSION['path'] = 'info';
    if(!isset($_GET['user_id'])){
        header('location: forum.php');
    }
    require_once('./database/database-function.php');
    if(isset($_POST['uploadSubmit']) && isset($_GET['user_id'])){
        $sql = "select name from users where user_id = ?";
        $name = simpleQuery($sql, 1, [$_GET['user_id']]);
        $targetDir = __DIR__."/userImages/";
        $typeOfFile = pathinfo($_FILES['userImage']['name'], PATHINFO_EXTENSION);
        if(count($name) > 0){
            $targetFile = $targetDir . $name[0]['name'].'.'.$typeOfFile;
        }else{
            $targetFile = $targetDir . $_FILES['userImage']['name'];
        }
        
        $update = 1;
        // getImage
        if($typeOfFile == 'jpg' || $typeOfFile == 'png' || $typeOfFile == 'jpeg' || $typeOfFile == 'gif'){
            cout($_FILES['userImage']);
            if(file_exists($targetFile)){
                // unlink($targetFile);
                echo "ton tai";
            }
            cout($targetFile);
            // if($_FILES['userImage']['size'] > 1500000){
            //     echo "<script>alert('Dung luong file qua lon');</script>";
            //     $update = 0;
            // }else{
            //     if($update == 1){
            //         if(move_uploaded_file($_FILES['userImage']['tmp_name'], $targetFile)){
            //             $sql = "update user_info set img = ? where user_id = ?";
            //             simpleQuery($sql, 0 , [$targetFile, $_GET['user_id']]);

            //             echo "<script>alert('Upload thanh cong reload lai trang de kiem tra');</script>";
            //         }else{
            //             echo "<script>alert('Co loi xay ra');</script>";
            //         }
            //     }
            // }
            echo "vao day";
            
        }else{
            echo "<script>alert('K phai file anh');</script>";
            $update = 0;
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
        
        <div class="row h-main-row bg-light" style="height: auto;">
            <div class="container h-main-con">
                <?php
                    //nav
                    include("forum/navbar.php");
                ?>
                <div class="row h-row-sec">
                    <div class="container-fluid">
                        <div class="row h-info-row">
                            
                            <div class="col-sm-5 h-info-con">
                                <?php
                                    $sql = "select email,role, name, create_at from users where user_id = ? limit 1";
                                    $user = simpleQuery($sql, 1, [$_GET['user_id']]);
                                    $userBirth = "";
                                    $editBirdth = "";
                                    if(count($user) > 0){

                                        
                                        $sql = "select real_name, birth, gender, last_online, img from user_info where user_id = ? limit 1";
                                        $info = simpleQuery($sql, 1, [$_GET['user_id']]);
                                        $userDate = date_format(date_create($user[0]['create_at']),'d/m/Y - H:i:s');
                                        $sql = "select article_id, create_at from articles where user_id = ? order by article_id desc";
                                        $article = simpleQuery($sql, 1, [$_GET['user_id']]);
                                        if(count($article) > 0){
                                            $articleDate = date_format(date_create($article[0]['create_at']),'d/m/Y - H:i:s');
                                        }
                                        
                                        if(count($user) > 0){
                                            echo '<div class="h-info-img">
                                                <div class="h-info-img-upload">';
                                                    if(isset($_SESSION['user_id'])){
                                                        if($_SESSION['user_id'] == $_GET['user_id']){
                                                            echo '<form action="forum-information.php?user_id='.$_GET['user_id'].'" method="POST" enctype="multipart/form-data">
                                                            <input type="file" name="userImage" class="h-userImage" required>
                                                            <input type="submit" name="uploadSubmit" class="h-upload-img" value="upload">
                                                        </form>';
                                                        }
                                                    }
                                                    
                                                echo '</div>
                                                <img src="';
                                                if(isset($info[0]['img'])){
                                                    echo $info[0]['img'];
                                                }else{
                                                    echo 'userImages/user-default-img.png';
                                                }
                                                echo '" alt="">
                                            </div>
                                            <div>
                                                <h4>'.$user[0]['name'].'</h4>
                                                <h6>';
                                                if($user[0]['role'] == 1){
                                                    echo "Admin";
                                                }else{
                                                    echo "Thanh vien";
                                                }
                                                echo '</h6>
                                            </div>';
                                        }
                                    }
                                ?>
                                
                            </div>
                            <div class="col-sm-7 h-info-detailed">
                                <?php
                                    if(isset($_GET['user_id'])){
                                        if(count($user) > 0){
                                        
                                            if(count($info)> 0){
                                                
                                                echo '<div>
                                                <div class="h-i-d-col1">
                                                <p>Ho va ten</p>
                                                <p>Gioi tinh</p>
                                                <p>Ngay sinh</p>
                                                <p>Tuoi</p>
                                                <p>Email</p>
                                                <p>Ngay gia nhap</p>
                                                <p>So bai dang</p>
                                                <p>Dang cuoi ngay</p>
                                                <p>Hoat dong lan cuoi</p>
            
                                                
                                                </div>
                                                <div class="h-i-d-col2">
                                                    <p>';
                                                    if($info[0]['real_name'] == ""){
                                                        echo "chua thiet lap";
                                                    }else{
                                                        echo $info[0]['real_name'];
                                                    }
                                                    echo '</p>
                                                    <p>';
                                                    if($info[0]['gender'] === ""){
                                                        echo "chua thiet lap";
                                                    }else{
                                                        if($info[0]['gender'] == 0){
                                                            echo "Nu";
                                                        }else{
                                                            echo "Nam";
                                                        }
                                                    }
                                                    echo '</p>
                                                    <p>';
                                                    if($info[0]['birth'] == ""){
                                                        echo "chua thiet lap";
                                                    }else{
                                                        $userBirth = date_format(date_create($info[0]['birth']),'d/m/Y');
                                                        $editBirdth = date_format(date_create($info[0]['birth']),'Y-m-d');
                                                        echo $userBirth;
                                                    }
                                                    echo '</p>
                                                    <p>';
                                                    if($info[0]['birth'] == ""){
                                                        echo "chua thiet lap";
                                                    }else{
                                                        $year = date('Y');
                                                        $userBirth = date_format(date_create($info[0]['birth']),'Y');
                                                        echo $year - $userBirth;
                                                    }
                                                    echo '</p>
                                                    <p>'.$user[0]['email'].'</p>
                                                    <p>'.$userDate.'</p>
                                                    <p>';
                                                    echo count($article);
                                                    echo '</p>
                                                    <p>';
                                                    if(count($article) > 0){
                                                        echo $articleDate;
                                                    }else{
                                                        echo "chua thiet lap";
                                                    }
                                                    echo '</p>
                                                    <p>';
                                                        $lastOnline = date_format(date_create($info[0]['last_online']),'d/m/Y - H:i:s');
                                                        echo $lastOnline;
                                                    echo '</p>
                                                </div>
                                            </div>';
                                            }else{
                                                echo '<div>
                                            <div class="h-i-d-col1">
                                            <p>Ho va ten</p>
                                            <p>Gioi tinh</p>
                                            <p>Ngay sinh</p>
                                            <p>Tuoi</p>
                                            <p>Email</p>
                                            <p>Ngay gia nhap</p>
                                            <p>So bai dang</p>
                                            <p>Dang cuoi ngay</p>
                                            <p>Hoat dong lan cuoi</p>
        
                                            
                                            </div>
                                            <div class="h-i-d-col2">
                                                <p>Chua thiet lap</p>
                                                <p>Chua thiet lap</p>
                                                <p>Chua thiet lap</p>
                                                <p>Chua thiet lap</p>
                                                <p>'.$user[0]['email'].'</p>
                                                <p>'.$userDate.'</p>
                                                <p>';
                                                echo count($article);
                                                echo '</p>
                                                <p>';
                                                if(count($article) > 0){
                                                    echo $articleDate;
                                                }else{
                                                    echo "chua thiet lap";
                                                }
                                                echo '</p>
                                                <p>chua thiet lap</p>
                                            </div>
                                        </div>';
                                            }
                                        }
                                    }
                                ?>
                                <?php
                                
                                if(count($user) > 0){
                                    if(isset($_SESSION['user_id'])){
                                        if($_SESSION['user_id'] == $_GET['user_id']){
                                            echo '<div class="h-info-edit" role="button" data-toggle="modal" data-target="#userEditModal" data-toggle="tooltip" data-placement="bottom" title="Sua thong tin"><i class="fas fa-ellipsis-h"></i></div>';
                                            $editable = 1;
                                        }
                                    }
                                }
                                
                                
                                ?>
                            </div>
                        </div>
                        <!-- Modal -->
                    <div class="modal fade" data-backdrop="static" id="userEditModal" data-backdrop="true" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div>
                                        <h4>Sua thong tin</h4>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="h-user-edit-con">
                                        <?php
        
                                        if($editable == 1){
                                            echo '<form action="forum-information.php" method="POST" onsubmit="return false">
                                            <div>
                                                <p>Ho va ten</p>
                                                <input class="h-user-edit-input" name="u_name" id="u-edit-name" type="text" value="'.$info[0]['real_name'].'">
                                            </div>
                                            <div>
                                                <p>Ngay sinh</p>
                                                <input class="h-user-edit-input" name="u_birth" id="u-edit-birth" type="date" value="'.$editBirdth.'">
                                            </div>
                                            <div>
                                                <p>Gioi tinh</p>
                                                <select class="h-user-edit-input" name="u_gender" id="u-edit-gender">';
                                                    if($info[0]['gender'] == 1){
                                                        echo '<option value="1" selected>Nam</option>';
                                                        echo '<option value="0">Nu</option>';
                                                    }else{
                                                        echo '<option value="1">Nam</option>';
                                                        echo '<option value="0" selected>Nu</option>';
                                                        
                                                    }
                                                    
                                                    
                                                echo '</select>
                                            </div>
                                            <div>
                                                <p>Email</p>
                                                <input class="h-user-edit-input" name="u_email" id="u-edit-email" type="email" value="'.$user[0]['email'].'">
                                            </div>
                                            <div>
                                                <p></p>
                                                <input type="submit" name="user_edit_sub" class="h-user-edit-save" value="Luu" onclick="return editUser('.$_SESSION['user_id'].')">
                                            </div>
                                            
                                        </form>';
                                        }
                                        
                                        ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div> 
                    <!-- //modal -->
                    </div>
                </div>
                
                
            </div>

        </div>
    </div>

    <script src="js/forum.js"></script>
</body>
</html>