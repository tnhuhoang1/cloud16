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

                                    <div class="h-topics-title">
                                    
                                        <div class="row">
                                            <div class="col-7">
                                                Tuyen sinh
                                            </div>
                                            <div class="col h-t-t-t">
                                                Tra loi
                                            </div>
                                            <div class="col h-t-t-t">
                                                Thoi gian
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                </div>
                                <div class="container-fluid">
                                    
                                    
                                        
                                    
                                    <div class="h-t-c-dis">
                                        <div class="row">
                                            <div class="col-7">
                                                <img src="images/i2.jpg" alt="" class="img-fluid h-user-img-title"> <a href="#" class="badge badge-primary h-badge">Cong dong IT</a>
                                                <div>
                                                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Beatae corrupti excepturi nostrum culpa explicabo iure accusantium delectus ipsam eaque eligendi impedit ad nulla, perferendis dolor dicta ex officiis nihil quibusdam.</p>
                                                </div>
                                            </div>
                                            <div class="col h-t-t-t">
                                                6 bình luận
                                            </div>
                                            <div class="col h-t-t-t">
                                                16/7/2000
                                            </div>
                                        </div>
                                        <div class="row h-t-c-c">
                                        

                                            <a href="" class="h-a"><i class="far fa-thumbs-up"></i>
                                            <i class="fas fa-thumbs-up"></i>Thích</a>
                                            <span role="button" data-toggle="modal" data-target="#replyModal" class="h-a h-reply"><i class="far fa-comments"></i> Trả lời</span>
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
                                                                        <form action="" > 
                                                                            <table>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><label for="username">Username: </label></td>
                                                                                        <td><input type="text" id= "username" class="h-text-input" placeholder = "your username"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        <td><label for="password">Password: </label></td>
                                                                                        <td><input type="password" id= "password" class="h-text-input" placeholder = "your password"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        <td></td>
                                                                                        <td><input type="checkbox" id="checkbox">
                                                                                            <label for="checkbox">Ghi nhớ đăng nhập</label>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        <td></td>
                                                                                        <td><button class="btn btn-primary" type="submit">Đăng nhập</button></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>                                                   
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div id="h-tabs-register" class="container tab-pane fade"><br>
                                                                    <div class="h-tab-login-form">
                                                                        <h3>Register</h3>
                                                                        <form action="" > 
                                                                            <table>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        
                                                                                        <td><input type="text" id= "username" class="h-text-input" placeholder = "Username"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        
                                                                                        <td><input type="email" id= "email" class="h-text-input" placeholder = "Email"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        
                                                                                        <td><input type="password" id= "password" class="h-text-input" placeholder = "Password"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        
                                                                                        <td><input type="password" id="password-confirm" class="h-text-input" placeholder = "Confirm password"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        
                                                                                        <td><input type="checkbox" id="checkbox">
                                                                                            <label for="checkbox">Toi chap nhan dieu khoan</label>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        
                                                                                        <td><button class="btn btn-primary btn-register" type="submit">Register now</button></td>
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
                                        <div class="row">
                                            <div class="col-sm">
                                                <div class="h-comment-log">
                                                    <div class="h-comment-log-user">
                                                        <img src="images/i2.jpg" alt="" class="img-fluid h-user-img-comment"> User name
                                                    </div>
                                                    <div class="h-c-l-comment">
                                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Recusandae placeat aspernatur odio hic eum deserunt dolores eaque labore necessitatibus sint ut quis nam, fugiat architecto neque alias tenetur eos natus.
                                                    </div>
                                                    <div class="h-comment-log-user">
                                                        <img src="images/i2.jpg" alt="" class="img-fluid h-user-img-comment"> User name
                                                    </div>
                                                    <div class="h-c-l-comment">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem voluptas corrupti, natus impedit veniam provident enim vitae, a est aliquam sed autem nisi quae repellat velit. Veritatis sequi accusantium similique.
                                                    </div>
                                                    <div class="h-comment-log-user">
                                                        <img src="images/i2.jpg" alt="" class="img-fluid h-user-img-comment"> User name
                                                    </div>
                                                    <div class="h-c-l-comment">
                                                        comment go here
                                                    </div>
                                                    <div class="h-comment-log-user">
                                                        <img src="images/i2.jpg" alt="" class="img-fluid h-user-img-comment"> User name
                                                    </div>
                                                    <div class="h-c-l-comment">
                                                        comment go here
                                                    </div>
                                                    <div class="h-comment-log-user">
                                                        <img src="images/i2.jpg" alt="" class="img-fluid h-user-img-comment"> User name
                                                    </div>
                                                    <div class="h-c-l-comment">
                                                        comment go here
                                                    </div>
                                                    <div class="h-comment-input">
                                                        <form action="" class="form h-form">
                                                            
                                                            <input type="text" placeholder="your comment">
                                                            <button type="submit" class="btn"><i class="fas fa-paper-plane"></i></button>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            

                                        </div>
                                    </div>
                                    <div class="h-t-c-dis">
                                        <div class="row">
                                            <div class="col-7">
                                                
                                                <img src="images/i2.jpg" alt="" class="img-fluid h-user-img-title"> <a href="#" class="badge badge-primary h-badge">Thong bao</a>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente id soluta, rerum modi asperiores voluptatibus ducimus unde nulla hic nam nesciunt explicabo voluptates perspiciatis, ea perferendis odit laudantium. Laudantium, vero. 
                                            </div>
                                            <div class="col h-t-t-t">
                                                6 bình luận
                                            </div>
                                            <div class="col h-t-t-t">
                                                16/7/2000
                                            </div>
                                        </div>
                                        <div class="row h-t-c-c">
                                    
                                            <a href="" class="h-a"><i class="far fa-thumbs-up"></i>
                                            <i class="fas fa-thumbs-up"></i>Thích</a>
                                            <span role="button" data-toggle="modal" data-target="#replyModal" class="h-a h-reply"><i class="far fa-comments"></i> Trả lời</span>
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
                                                                        <form action="" > 
                                                                            <table>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><label for="username">Username: </label></td>
                                                                                        <td><input type="text" id= "username" class="h-text-input" placeholder = "your username"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        <td><label for="password">Password: </label></td>
                                                                                        <td><input type="password" id= "password" class="h-text-input" placeholder = "your password"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        <td></td>
                                                                                        <td><input type="checkbox" id="checkbox">
                                                                                            <label for="checkbox">Ghi nhớ đăng nhập</label>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        <td></td>
                                                                                        <td><button class="btn btn-primary" type="submit">Login</button></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>                                                   
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div id="h-tabs-register" class="container tab-pane fade"><br>
                                                                    <div class="h-tab-login-form">
                                                                        <h3>Register</h3>
                                                                        <form action="" > 
                                                                            <table>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        
                                                                                        <td><input type="text" id= "username" class="h-text-input" placeholder = "Username"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        
                                                                                        <td><input type="email" id= "email" class="h-text-input" placeholder = "Email"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        
                                                                                        <td><input type="password" id= "password" class="h-text-input" placeholder = "Password"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        
                                                                                        <td><input type="password" id="password-confirm" class="h-text-input" placeholder = "Confirm password"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        
                                                                                        <td><input type="checkbox" id="checkbox">
                                                                                            <label for="checkbox">Toi chap nhan dieu khoan</label>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        
                                                                                        
                                                                                        <td><button class="btn btn-primary btn-register" type="submit">Register now</button></td>
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
                                        <div class="row">
                                            <div class="col-sm">
                                                <div class="h-comment-log">
                                                    <div class="h-comment-log-user">
                                                        <img src="images/i2.jpg" alt="" class="img-fluid h-user-img-comment"> User name
                                                    </div>
                                                    <div class="h-c-l-comment">
                                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Recusandae placeat aspernatur odio hic eum deserunt dolores eaque labore necessitatibus sint ut quis nam, fugiat architecto neque alias tenetur eos natus.
                                                    </div>
                                                    <div class="h-comment-log-user">
                                                        <img src="images/i2.jpg" alt="" class="img-fluid h-user-img-comment"> User name
                                                    </div>
                                                    <div class="h-c-l-comment">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem voluptas corrupti, natus impedit veniam provident enim vitae, a est aliquam sed autem nisi quae repellat velit. Veritatis sequi accusantium similique.
                                                    </div>
                                                    <div class="h-comment-log-user">
                                                        <img src="images/i2.jpg" alt="" class="img-fluid h-user-img-comment"> User name
                                                    </div>
                                                    <div class="h-c-l-comment">
                                                        comment go here
                                                    </div>
                                                    <div class="h-comment-log-user">
                                                        <img src="images/i2.jpg" alt="" class="img-fluid h-user-img-comment"> User name
                                                    </div>
                                                    <div class="h-c-l-comment">
                                                        comment go here
                                                    </div>
                                                    <div class="h-comment-log-user">
                                                        <img src="images/i2.jpg" alt="" class="img-fluid h-user-img-comment"> User name
                                                    </div>
                                                    <div class="h-c-l-comment">
                                                        comment go here
                                                    </div>
                                                    <div class="h-comment-input">
                                                        <form action="" class="form h-form">
                                                            
                                                            <input type="text" placeholder="your comment">
                                                            <button type="submit" class="btn"><i class="fas fa-paper-plane"></i></button>
                                                        </form>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            

                                        </div>
                                    </div>
                                    <div class="h-t-c-dis">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                Tuyen sinh
                                            </div>
                                            <div class="col-sm-3 h-t-t-t">
                                                Tra loi
                                            </div>
                                            <div class="col-sm-3 h-t-t-t">
                                                Thoi gian
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="h-t-c-dis">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                Tuyen sinh
                                            </div>
                                            <div class="col-sm-3 h-t-t-t">
                                                Tra loi
                                            </div>
                                            <div class="col-sm-3 h-t-t-t">
                                                Thoi gian
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="h-t-c-dis">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                Tuyen sinh
                                            </div>
                                            <div class="col-sm-3 h-t-t-t">
                                                Tra loi
                                            </div>
                                            <div class="col-sm-3 h-t-t-t">
                                                Thoi gian
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <!-- pagination -->
                                    <nav aria-label="main pagination">
                                        <ul class="pagination justify-content-center h-pagination">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <!-- //pagination -->
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="h-side-bar">
                                    <!-- quick ask -->
                                    <div class="h-quick-ask">
                                        <div class="h-q-a-title">
                                            <h4>Cau hoi nhanh</h4>
                                        </div>
                                        <div class="h-m-a-post">
                                            <h6><a href="forum-article.php" class="h-a" data-toggle="modal" data-target="#hSidebarQuickAsk">Tuyen sinh truc tuyen la nguy hiem cho tre em duoi 18 tuoi</a></h6>
                                            <p class="h-p-i">16/7/2000</p>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="hSidebarQuickAsk" data-backdrop="true" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div>
                                                            <h5 class="modal-title h-a-m-title" id="staticBackdropLabel">Tuyen sinh truc tuyen la nguy hiem cho tre em duoi 18 tuoi</h5>
                                                            <p class="h-p-i">16/7/2000</p>
                                                        </div>
                                                        
                                                            
                                                        
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="h-q-comment">
                                                            <p><span>Tra loi: </span> Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae harum numquam eos dolores consectetur ratione quod debitis earum ab, libero quis nihil cupiditate quos impedit? Sunt soluta cum culpa sit.</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                            <p><span>Tra loi: </span> Ban k nen lam nhu vay, ac lam</p>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    <div class="modal-footer" style="display: block;">
                                                        <div class="h-comment-input">
                                                            <form action="" class="form h-form">
                                                                
                                                                <input type="text" placeholder="your comment">
                                                                <button type="submit" class="btn"><i class="fas fa-paper-plane"></i></button>
                                                            </form>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <!-- //modal -->
                                

                                        <div class="h-m-a-post">
                                            <h6><a href="forum-article.php" class="h-a">Tuyen sinh truc tuyen la nguy hiem cho tre em duoi 18 tuoi</a></h6>
                                            <p>16/7/2000</p>
                                        </div>
                                        <div class="h-m-a-post">
                                            <h6><a href="forum-article.php" class="h-a">Tuyen sinh truc tuyen la nguy hiem cho tre em duoi 18 tuoi</a></h6>
                                            <p>16/7/2000</p>
                                        </div>
                                        <div class="h-m-a-post">
                                            <h6><a href="forum-article.php" class="h-a">Tuyen sinh truc tuyen la nguy hiem cho tre em duoi 18 tuoi</a></h6>
                                            <p>16/7/2000</p>
                                        </div>
                                    </div>
                                    <?php
                                    // most asked
                                    include("forum/most-asked.php");
                                    ?>
                                    <div class="h-member">
                                        <div><a>số thành viên: </a><span>111</span></div>
                                        <div><a>Tổng số bài: </a><span>16</span></div>

                                    </div>
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

    <script src="js/forum.js"></script>
</body>
</html>