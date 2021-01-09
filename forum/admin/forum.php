<?php
    session_start();
    if(isset($_SESSION['status']) && $_SESSION['role'] == 1){
    }else{
        header("location: ../../forum.php");
    }
    require_once("../../database/database-function.php");
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $_SESSION['admin-path'] = 'forum';
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row h-ad-logo">
            <?php
                include_once('admin-topbar.php');
            ?>
            
            <div class="col-9">
                <div>
                    <h4>Tong quan</h4>
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
                <div class="h-control-row1">
                    <div id="chart_div"></div>

                </div>
                <div class="h-control-row2">
                    <div class="h-online-count">
                        <div>
                            <i class="fas fa-globe-asia"></i>
                        </div>
                        <?php
                            $sql = "select users.user_id, last_online from users, user_info where users.user_id = user_info.user_id and last_online >= date_sub(?, INTERVAL 0 day) and last_online <= date_add(?, INTERVAL 1 day)";
                            
                            $today = date('Y/m/d');
                            $today = date_create($today);
                            $dateFormat = date_format($today, 'Y-m-d H:i:s');
                            $user = simpleQuery($sql,1,[$dateFormat, $dateFormat]);
                            $userCount = 0;
                            $areOnline = 0;
                            $now = date_create();
                            foreach($user as $v){
                                
                                $lastOnline = date_create($v['last_online']);
                                $diffDay = date_diff($today,$lastOnline);
                                
                                if($diffDay -> d == 0){
                                    $userCount++;
                                }
                                $diffMin = date_diff($now,$lastOnline);
                                if($diffMin -> days == 0 && $diffMin -> h == 0 && $diffMin -> i < 5){
                                    $areOnline++;
                                }
                            }
                            echo '<div>
                                <div>So nguoi online hom nay: </div>
                                <div>'.$userCount.'</div>
                            </div>
                            <div>
                                <div>So nguoi dang online: </div>
                                <div>'.$areOnline.'</div>
                            </div>';
                        ?>
                        
                    </div>
                    <div class="h-article_count">
                        <div>
                            <i class="fas fa-sticky-note"></i>
                        </div>
                        <div class="h-article_count-con">
                            <div>
                                So cau hoi trong ngay: 
                            </div>
                            <div>
                            <?php
                            $today = date_create(date('Y-m-d'));
                            $sql = "select article_id, create_at from articles where is_publish = 0 and create_at >= date_sub(?, INTERVAL 0 day) and create_at <= date_add(?, INTERVAL 1 day)";
                            $dateFormat = date_format($today, 'Y-m-d H:i:s');
                            $article = simpleQuery($sql, 1, [$dateFormat, $dateFormat]);
                                echo count($article);
                            ?>
                            </div>
                        </div>
                        
                    </div>
                    <div class="h-waiting-article">
                        <div>
                        <i class="fas fa-clock"></i>
                        </div>
                        <div class="h-waiting-article-con">
                            <div>
                            So cau hoi dang cho duyet:
                            </div>
                            <div>
                                <?php
                                    $sql = "select article_id from articles where is_publish != 0";
                                    $article = simpleQuery($sql);
                                    echo (count($article));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-control-row3">
                    <div class="h-recent-post">
                        <div>Nhung bai duyet gan day</div>
                        <?php
                        $sql = "select title,user_id, id_duyet, publish_date from articles where id_duyet != 0 ORDER by publish_date desc limit 5";
                        $article = simpleQuery($sql);
                        if(count($article) == 0){
                            echo '<div style="text-align: center; padding: 10px;">Danh sach rong</div>';
                        }else{
                            
                            echo '<div class="h-recent-title h-recent-table">
                                    <div>STT</div>
                                    <div>Tieu de</div>
                                    <div>Nguoi dang</div>
                                    <div>Thoi gian</div>
                                    <div>Nguoi duyet</div>
                                </div>';
                        
                            
                            $i = 1;
                            foreach($article as $v){
                                $sql = "select name from users where user_id = ?";
                                $user1 = simpleQuery($sql,1,[$v['user_id']]);
                                $sql = "select name from users where user_id = ?";
                                $user2 = simpleQuery($sql,1,[$v['id_duyet']]);
                                $date = date_format(date_create($v['publish_date']), 'd/m/Y H:i:s');
                                echo '<div class="h-recent-table">
                                    <div>'.$i.'</div>
                                    <div>'.$v['title'].'</div>
                                    <div>'.$user1[0]['name'].'</div>
                                    <div>'.$date.'</div>
                                    <div>'.$user2[0]['name'].'</div>
                                </div>';
                                $i++;
                            }
                        }
                        
                        
                        ?>
                        

                    </div>

                </div>
                
                
            </div>
        </div>
    </div>
    <?php
            
            $startInterval = $today;
            // $endInterval = $today;
            
            // $dateInter = new DateInterval('P0D');
            // date_sub($startInterval, $dateInter);
            $dateInter = new DateInterval('P1D');
            $sql = "select article_id, create_at from articles where is_publish = 0 and create_at >= date_sub(?, INTERVAL 0 day) and create_at <= date_add(?, INTERVAL 1 day)";
            // cout($dateInter);
            $record = null;
            
    ?>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      
      function drawChart() {
        <?php
        $end = date_format($startInterval, 'd');
        $month = date_format($startInterval, 'm');
        echo "var data = google.visualization.arrayToDataTable([";
        echo "['ngay', 'So bai dang', ''],";
        for($i = 0; $i < $end; $i++){
            if($i==0){
                $dateFormat = date_format($startInterval, 'Y-m-d H:i:s');
                $dateFormatDay = date_format($startInterval, 'd');
                $record = simpleQuery($sql, 1, [$dateFormat, $dateFormat]);
                $sl = count($record);
                echo "[$dateFormatDay, $sl , 0],";
            }else{
                date_sub($startInterval, $dateInter);
                $dateFormat = date_format($startInterval, 'Y-m-d H:i:s');
                $dateFormatDay = date_format($startInterval, 'd');
                $record = simpleQuery($sql, 1, [$dateFormat, $dateFormat]);
                $sl = count($record);
                echo "[$dateFormatDay, $sl , 0],";
            }
        } 
        echo "]);";
        echo 'var options = {
            title: \'Thong ke nguoi dung dang bai\',
            hAxis: {title: \'Thang '.$month.'\',  titleTextStyle: {color: \'#333\'}},
            vAxis: {minValue: 0}
          };';
        ?>
        

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
</body>
</html>