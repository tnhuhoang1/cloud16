<div class="row h-logo-row">
            <div class="col-lg-2">
                <div class="h-logo">
                    <a href="https://console.cloud.google.com/home/dashboard?project=cloud-16" target="_blank" class="h-a"><Span class="h-char-1">C</span><Span class="h-char-2">1</span><Span  class="h-char-3">6</Span></a>     
                </div>
            </div>
            <div class="col-lg-10 h-user-row">
                <div class="h-user-shortcut">
                    <ul class="h-user-shortcut-con">
                        <!-- <li class="h-li" role="button" data-toggle="modal" data-target="#quickQuestionModal"><i class="fas fa-plus" data-toggle="tooltip" data-placement="bottom" title="Tao cau hoi nhanh k can dang nhap"> Tao cau hoi</i></li> -->
                        <?php
                            if(isset($_SESSION['username'])){
                                echo '<li class="h-li h-nav-link"><a href="forum-create-quest.php" class="h-a"><i class="fas fa-plus" data-toggle="tooltip" data-placement="bottom" title="Tạo câu hỏi hoạc thông báo" > Thêm bài viết</i></a></li>';
                            }else{
                                echo '<li class="h-li h-nav-link"><a href="#" type="button" data-toggle="modal" data-target="#replyModal" class="h-a"><i class="fas fa-plus" data-toggle="tooltip" data-placement="bottom" title="Đặng nhập để tạo câu hỏi" > Thêm bài viết</i></a></li>';
                            }
                        ?>
                        
                        <li class="h-li h-nav-link"><a href="forum-category.php" class="h-a" ><i class="fas fa-tags"> Danh mục</i></a></li>
                        <?php
                            if(isset($_SESSION['status']) && $_SESSION['status'] == "logged"){
                                // echo '<li class="h-li h-nav-link"><a href="forum-category.php" class="h-a" ><i class="fas fa-reply"> Chua tra loi</i></a></li>';
                            }
                        ?>
                        
                        <li class="h-li h-nav-link"><a href="https://drive.google.com/file/d/12-vKc5tmKc39U-Zzy9n3RBkxW8B_reHh/view?usp=sharing" class="h-a"><i class="fab fa-android"><strong> App điện thoại</strong></a></i></li>
                        <li class="h-li h-nav-link"></li>
                        <li class="h-li h-nav-link"></li>
                    </ul>
                    <!-- Modal -->
                    <!-- <div class="modal fade" id="quickQuestionModal" data-backdrop="true" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header h-qq-modal-header">
                                    <div>
                                        Tao cau hoi nhanh
                                    </div>
                                </div>
                                <div class="modal-body h-add-qq-body">
                                    <form method="POST" onsubmit="return postQuickQuest()">
                                        <div>
                                            <label for="addQuestionTxt">Ten cau hoi: </label>
                                            <input type="text" id="addQuestionTxt" name="h-txt-input" class="h-text-input h-add-quest-text" required>
                                        </div>
                                        <div>
                                            <button type="submit" class="h-d" name ="h-submit-btn" style="color:white;">Dang</button>
                                        </div>
                                        
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>  -->
                    <!-- //modal -->
                    
                    <div class="h-full-alert" id="h-full-alert">
                        <div>
                        
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="replyModal" data-backdrop="true" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                
                                <div class="modal-body">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#h-tabs-login">Login</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#h-tabs-register">Register</a>
                                        </li>
                                        
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div id="h-tabs-login" class="container tab-pane active"><br>
                                            <div class="h-tab-login-form">
                                                <h3>Login</h3>
                                                <div class="h-errors" id="h-log-errors">
                                                </div>
                                                <form action="forum.php" method="POST" onsubmit="return logCheck()"> 
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td><label for="username">Username: </label></td>
                                                                <td><input type="text" name = "log-username" id= "log-username" class="h-text-input" placeholder = "your username" required></td>
                                                            </tr>
                                                            <tr>
                                                                
                                                                <td><label for="password">Password: </label></td>
                                                                <td><input type="password" name = "log-password" id= "log-password" class="h-text-input" placeholder = "your password" required></td>
                                                            </tr>
                                                            <!-- <tr>
                                                                
                                                                <td></td>
                                                                <td><input type="checkbox" id="checkbox" name="log-remember">
                                                                    <label for="checkbox">Ghi nho dang nhap</label>
                                                                </td>
                                                            </tr> -->
                                                            <tr>
                                                                
                                                                <td></td>
                                                                <td><button class="btn btn-primary" type="submit" name="log-btn">Login</button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>                                                   
                                                </form>
                                            </div>
                                        </div>
                                        
                                        <div id="h-tabs-register" class="container tab-pane fade"><br>
                                            <div class="h-tab-login-form">
                                                <h3>Register</h3>
                                                
                                                    
                                                    <div class="h-errors" id="h-res-errors">
                                                    </div>
                                                    
                                                    
                                                
                                                <form action="forum.php" method="post" onsubmit="return resCheck()"> 
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                
                                                                <td><input type="text" id= "res-username" name="res-username" class="h-text-input" placeholder = "Username" required ></td>
                                                            </tr>
                                                            <tr>
                                                                
                                                                
                                                                <td><input type="email" id= "res-email" name= "res-email" class="h-text-input" placeholder = "Email" required></td>
                                                            </tr>
                                                            <tr>
                                                                
                                                                
                                                                <td><input type="password" id= "res-password" name= "res-password" class="h-text-input" placeholder = "Password" required></td>
                                                            </tr>
                                                            <tr>
                                                                
                                                                
                                                                <td><input type="password" id= "res-password-confirm" name="res-password-confirm" class="h-text-input" placeholder = "Confirm password" required></td>
                                                            </tr>
                                                            
                                                            <tr>
                                                                
                                                                
                                                                <td><button class="btn btn-primary btn-register" name="res-btn" type="submit">Register now</button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>                                                   
                                                </form>
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div> 
                    <!-- //modal -->
                    
                </div>
                <div class="h-user">
                    <div class="h-u-panel">
                        <ul>
                            <li class="h-li">
                                <div class="dropdown">
                                    <button class="h-b-account" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-users"></i> Tài khoản
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                    <?php
                                        if(isset($_SESSION['status'])){
                                            $sql = "select img from user_info where user_id = ?";
                                            $info = simpleQuery($sql, 1, [$_SESSION['user_id']]);
                                            echo '<div class="dropdown-header h-user-username">';
                                                if(count($info) > 0){
                                                    echo '<img src="'.$info[0]['img'].'"  class="h-user-avatar">';
                                                }else{
                                                    echo '<img src="images/i1.jpg"  class="h-user-avatar">';
                                                }
                                                
                                                echo '<h6>'.$_SESSION['username'].'</h6>
                                            </div>';
                                            if($_SESSION['role'] == 1){
                                                echo '<button class="dropdown-item" type="button"><a href="forum/admin/forum.php" class="h-a">Bảng thống kê</a></button>';
                                            }
                                        
                                            echo '<button class="dropdown-item" type="button"><a href="forum-information.php?user_id=';
                                            if(isset($_SESSION['user_id'])){
                                                echo $_SESSION['user_id'];
                                            }
                                            echo '" class="h-a">Thông tin</a></button>
                                            <button class="dropdown-item" type="button"><a href="forum-members.php" class="h-a">Thành viên</a></button>
                                            <button class="dropdown-item" type="button" onclick="logout()" ><a href="#" class="h-a">Đăng xuất</a></button>';
                                        }else{
                                            echo '<button class="dropdown-item" type="button" data-toggle="modal" data-target="#replyModal">Đăng nhâp/Đăng ký</button>';
                                        }
                                        
                                        
                                        

                                    ?>
                                    </div>
                                </div>
                                    
                                
                            </li>
                            
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>