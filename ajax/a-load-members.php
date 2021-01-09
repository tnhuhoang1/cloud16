<?php
    require_once("../database/database-function.php");
    if(isset($_POST['page']) && isset($_POST['sql'])){
        $max = $_POST['max'];
        $start = ($_POST['page'] - 1) * $max;
        $key = "%$_POST[sql]%";
        $sql = "select user_id, name, role, create_at from users where name like '$key'";
        $sql = $sql." limit $start, $max";
        $record = simpleQuery($sql);
        if(count($record) > 0){
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
        }else{
            echo '<div class="h-mem-mem"> 
                <div class="row h-mem-row">
                    <div class="col-12">K tim thay ket qua nao</div>
                </div>
                </div>';
        }
        
    }else if(isset($_POST['page'])){
        $max = $_POST['max'];
        $start = ($_POST['page'] - 1) * $max;
        
        $sql = "select user_id, name, role, create_at from users limit $start, $max";
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
    }
 
?>