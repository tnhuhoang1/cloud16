<?php
    session_start();
    if(isset($_SESSION['status']) && $_SESSION['role'] == 1){
    }else{
        header("location: ../../forum.php");
    }
    require_once("../../database/database-function.php");
    if(isset($_POST['role'])){
        $sql = "select role from users where role = 1";
        $user = simpleQuery($sql);
        if(count($user) > 1){
            $sql = "update users set role = ? where user_id = ?";
            simpleQuery($sql,0, [$_POST['role'], $_POST['u_id']]);
        }else{
            if($_POST['role'] == 1){
                $sql = "update users set role = ? where user_id = ?";
                simpleQuery($sql,0, [$_POST['role'], $_POST['u_id']]);
            }
            
        }
        
    }
    $_SESSION['admin-path'] = 'user';
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
                    <form action="users.php" method="POST">
                        <table class="h-user-table-edit">
                            <tr>
                                <td>Chuc vu</td>
                                <td><select id="user-role-select" name="role">
                                    <option value="0">Nguoi dung</option>    
                                    <option value="1">Admin</option>    
                                </select></td>
                            </tr>
                            <tr class="h-user-table-submit">
                                <td colspan="2">
                                    <input type="submit" value="Luu">
                                    <input type="password" name="u_id" value="" id="id_user" style="display:none">
                                </td>
                                
                            </tr>
                        </table>
                    
                    </form>











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
                    <h4>Quan li nguoi dung</h4>
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
                    <div class="h-a-content">
                        <div class="h-a-c-title">
                            <div class="h-s-row1">
                                STT
                            </div>
                            <div class="h-a-c-row2">
                                USERNAME
                            </div>
                            <div class="h-a-c-row3">
                                ROLE
                            </div>
                            <div class="h-a-c-row4">
                            EDIT
                            </div>
                                
                            <div class="h-a-c-row5">
                                DELETE
                            </div>
                        </div>
                        <?php
                            $sql = "select name, role, user_id from users";
                            $user = simpleQuery($sql);
                            $i = 1;
                            foreach($user as $v){
                                echo '<div class="h-a-c-content">
                                <div class="h-s-row1">
                                    '.$i.'
                                </div>
                                <div class="h-a-c-row2">
                                    <a href="#" class="h-a">'.$v['name'].'</a>
                                </div>
                                <div class="h-a-c-row3">';
                                if($v['role'] == 0){
                                    echo 'Thanh vien';
                                }else{
                                    echo 'Admin';
                                }
                                echo '</div>
                                <div class="h-a-c-row4">
                                    <a href="#" role="button" data-toggle="modal" data-target="#modalEdit" data-id = "'.$v['user_id'].'" onclick="passUserId(this)"><i class="fas fa-user-edit"></i></a>    
                                </div>
                                    
                                <div class="h-a-c-row5">
                                    <a href="#"><i class="fas fa-user-times"></i></a>
                                </div>
                            </div>';
                            $i++;
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