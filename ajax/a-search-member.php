<?php
    require_once("../database/database-function.php");
    if(isset($_POST['s'])){
        // $key = "$_POST[s]%";
        // $sql = "select user_id, name, role, create_at from users where name like '$key'";
        // echo $sql;
        echo $_POST['s'];
        // $record = simpleQuery($sql, 1, ["%$_POST[s]%"]);
        // if(count($record) > 0){
            
        //     foreach($record as $v){
        //         $sql = "select img from user_info where user_id = ?";
        //         $info = simpleQuery($sql, 1, [$v['user_id']]);
        //         echo '<div class="h-mem-mem"> 
        //         <div class="row h-mem-row">
                    
        //             <div class="col-3 h-mem-col">
                        
        //                 <div>
        //                     <img src="'.$info[0]['img'].'" alt="" class="h-mem-row-user-img">
        //                 </div>
        //                 <div>
        //                     <a href="forum-information.php?user_id='.$v['user_id'].'" class="h-a">'.$v['name'].'</a>
        //                 </div>
        //             </div>
        //             <div class="col-2">';
        //             if($v['role'] == 1){
        //                 echo 'Admin';
        //             }else{
        //                 echo 'Thanh vien';
        //             }
        //             echo '</div>
        //             <div class="col-2">'.$v['create_at'].'</div>
        //             <div class="col-2">';
        //             $sql = "select count(article_id) as count from articles where user_id = ?";
        //             $row = simpleQuery($sql, 1, [$v['user_id']]);
        //             echo $row[0]['count'];
        //             echo '</div>
        //             <div class="col-3">';
        //                 $sql = "select last_online from user_info where user_id = ?";
        //                 $info = simpleQuery($sql,1, [$v['user_id']]);
        //                 echo $info[0]['last_online'];
        //             echo '</div>
        //         </div>
                
        //     </div>';
        //     }
        // }





        
    }



?>