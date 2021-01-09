<?php
    session_start();
    require_once("./database/database-function.php");
    $_SESSION['path'] = 'member';
    $max = 15;
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
                            <div class="col-sm-12" style="padding-right: 30px;">    
                                <div class="container-fluid h-cate-main">
                                    <div class="row h-mem-search">
                                        <div class="col-6">
                                            <nav aria-label="...">
                                                <ul class="pagination" id="member-pagination">
                                                    <?php
                                                         $sql = "select user_id from users";
                                                         
                                                         $article = simpleQuery($sql);
                                                         $total = count($article);
                                                         $totalPages = intdiv($total, $max);
                                                         $redundant = (int)$total % (int)$max;
                                                         $pages = $totalPages;
                                                         if($redundant > 0){
                                                             $pages++;
                                                         }
                                                        
                                                         echo '<li class="page-item disabled">
                                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                                    </li>';
                                                         for($i = 1; $i <= $pages; $i++){
                                                             if($i == 1){
                                                                 echo '<li class="page-item active"><a class="page-link" href="#" onclick="return pagination('.$i.','.$max.',false)">'.$i.'</a></li>';
                                                             }else{
                                                                 echo '<li class="page-item"><a class="page-link" onclick="return pagination('.$i.','.$max.',false)">'.$i.'</a></li>';
                                                             }
                                                         }
                                                    if($pages > 1){
                                                        echo '<li class="page-item">
                                                        <a class="page-link" href="#" onclick="return pagination(2,'.$max.',false)">Next</a>
                                                    </li>';
                                                    }else{
                                                        echo '<li class="page-item disabled">
                                                        <a class="page-link" href="#">Next</a>
                                                    </li>';
                                                    }
                                                    
                                                    ?>
                                                    
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="h-text-input" placeholder="Tim kiem nguoi dung" oninput="searchMember(this,1,<?php echo $max?>)">
                                        </div>
                                    </div>
                                    <div class="row h-mem-header">
                                        <div class="col-3">Ten nguoi dung</div>
                                        <div class="col-2">Chuc vu</div>
                                        <div class="col-2">Ngay gia nhap</div>
                                        <div class="col-2">So bai dang</div>
                                        <div class="col-3">Truy cap lan cuoi</div>
    
                                    </div>
                                    <div id="member-container">
                                    <?php
                                        $sql = "select user_id, name, role, create_at from users limit $max";
                                        $record = simpleQuery($sql);
                                        foreach($record as $v){
                                            $sql = "select img from user_info where user_id = ?";
                                            $info = simpleQuery($sql, 1, [$v['user_id']]);
                                            echo '<div class="h-mem-mem"> 
                                            <div class="row h-mem-row">
                                               
                                                <div class="col-3 h-mem-col">
                                                    
                                                    <div>
                                                        <img src="'.$info[0]['img'].'" alt="" class="h-mem-row-user-img">
                                                    </div>
                                                    <div>
                                                        <a href="forum-information.php?user_id='.$v['user_id'].'" class="h-a">'.$v['name'].'</a>
                                                    </div>
                                                </div>
                                                <div class="col-2">';
                                                if($v['role'] == 1){
                                                    echo 'Admin';
                                                }else{
                                                    echo 'Thanh vien';
                                                }
                                                echo '</div>
                                                <div class="col-2">'.$v['create_at'].'</div>
                                                <div class="col-2">';
                                                $sql = "select count(article_id) as count from articles where user_id = ?";
                                                $row = simpleQuery($sql, 1, [$v['user_id']]);
                                                echo $row[0]['count'];
                                                echo '</div>
                                                <div class="col-3">';
                                                    $sql = "select last_online from user_info where user_id = ?";
                                                    $info = simpleQuery($sql,1, [$v['user_id']]);
                                                    echo $info[0]['last_online'];
                                                echo '</div>
                                            </div>
                                            
                                        </div>';
                                        }

                                        
                                    ?>
                                    </div>
                                    
                                    

                                    
                                    
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-12">
                           
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