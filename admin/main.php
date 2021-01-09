<?php
    session_start();
    if(!isset($_SESSION['cse-username']) || !isset($_SESSION['cse-role'])){
        header("location: ../index.php");
    }
    require_once("./database-function.php");
    $error = array();
    $success = "";
    if(isset($_POST['submit-user'])){
        $_SESSION['add_user'] = "true";
        if($_POST['txt-name'] == ""){
            array_push($error,"Ten nguoi dung de trong");
        }else if($_POST['txt-username'] == ""){
            array_push($error,"Ten dang nhap de trong");
        }else if($_POST['txt-password'] == ""){
            array_push($error,"Mat khau de trong");
        }else if($_POST['txt-password-confirm'] == ""){
            array_push($error,"Nhap lai mat khau de trong");
        }else if($_POST['txt-email'] == ""){
            array_push($error,"Email de trong");
        }else if($_POST['txt-phone'] == ""){
            array_push($error,"SDT de trong");
        }else if($_POST['txt-password'] != $_POST['txt-password-confirm']){
            array_push($error,"Nhap lai mat khau sai");
        }else{
            $sql = "select username, email, sdt from users where username like ? or email like ? or sdt like ?";
            $user = simpleQuery($sql, 1, [$_POST['txt-username'], $_POST['txt-email'], $_POST['txt-phone']]);

            foreach($user as $v){
                if($_POST['txt-username'] == $v['username']){
                    array_push($error, "Da ton tai username nay");
                    break;
                }else if($_POST['txt-email'] == $v['email']){
                    array_push($error, "Da ton tai eamil nay");
                    break;
                }else if($_POST['txt-phone'] == $v['sdt']){
                    array_push($error, "Da ton tai sdt nay");
                    break;
                }
                

            }
            if(count($error) ==0){
                $sql = "insert into users set name = ?, username = ?, password = ?, sdt = ?, email = ?";
                $password = password_hash($_POST['txt-password'], PASSWORD_DEFAULT);
                simpleQuery($sql, 0, [$_POST['txt-name'],$_POST['txt-username'],$password,$_POST['txt-phone'], $_POST['txt-email']]);
                $success = "Them user thanh cong";
           
            }
        }
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
                <!-- <div class="h-alert">
                    Thong bao
                </div> -->
                <?php
                    if(isset($_SESSION['add_user'])){
                        echo '
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>';
                            if(count($error) != 0){
                                echo $error[0];
                            }else{
                                echo $success;
                            }
                        echo '</strong> 
                        </div>';
                        unset($_SESSION['add_user']);
                    }
                    
                ?>
                
                <div style="border-bottom: 1px solid gray;">
                    <h4>Quan li nguoi dung</h4>
                </div>
                <div>
                    <button class="h-btn h-btn-adduser" data-toggle="modal" data-target="#userModal">Them nguoi dung</button>
                </div>

                <div class="h-flex-verticle h-user-title">
                    <div>STT</div>
                    <div>Ho va ten</div>
                    <div>SDT</div>
                    <div>Email</div>
                    <div>Xoa</div>

                </div>
                
                    <?php
                        $sql = "select name,sdt, email, user_id, role from users";
                        $user = simpleQuery($sql);
                        $i = 1;
                        foreach($user as $v){
                            
                            echo '<div class="h-flex-verticle h-user-content">
                            <div>'.$i.'</div>
                            <div>'.$v['name'].'</div>
                            <div>'.$v['sdt'].'</div>
                            <div>'.$v['email'].'</div>';
                            if($_SESSION['cse-role'] == 0){
                                echo '<div><i class="fas fa-user-times h-disabled"></i></div>';
                            }else{
                                echo '<div><i class="fas fa-user-times h-ad-delete-user-icon" onclick="adminDelete('.$v['user_id'].')"></i></div>';
                            }
                            
                            echo '</div>';
                            $i++;
                        }
                    ?>
                    
                
                <!-- Modal -->
                <div class="modal fade" id="userModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Them nguoi dung</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="main.php" method="POST">
                                <div>
                                    <input type="text" pattern="[a-zA-Z\s]*" title="K nhap ki tu dac biet va so, nhap ten tieng viet k dau" name="txt-name" class="h-input-txt" placeholder="Ho va ten" required>
                                </div>
                                <div>
                                    <input type="text" pattern="[\w]*" title="K nhap ki tu dac biet" name="txt-username" class="h-input-txt" placeholder="Ten dang nhap" required>
                                </div>
                                <div>
                                    <input type="password" name="txt-password" class="h-input-txt" placeholder="Mat khau" required>
                                </div>
                                <div>
                                    <input type="password" name="txt-password-confirm" class="h-input-txt" placeholder="Nhap lai mat khau" required>
                                </div>
                                <div>
                                    <input type="email" name="txt-email" class="h-input-txt" placeholder="Email" required>
                                </div>
                                <div>
                                    <input type="text" maxlength="10" pattern="[0-9]{10}" title="Phai nhap 10 chu so" name="txt-phone" class="h-input-txt" placeholder="So dien thoai" required>
                                </div>
                                <div>
                                    <input type="submit" name="submit-user" value="Them">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>
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
    
    




    

    <script src="js/js.js">
    </script>
</body>


</html>