<?php
    require_once("../database/database-function.php");
    if(isset($_POST['page']) && isset($_POST['sql'])){
        $key = "%$_POST[sql]%";
        $sql = "select user_id, name, role, create_at from users where name like '$key'";
        $record = simpleQuery($sql);
        if(count($record) > 0){
            $max = $_POST['max'];
            $total = count($record);
            $totalPages = intdiv($total, $max);
            $redundant = (int)$total % (int)$max;
            $pages = $totalPages;
            if($redundant > 0){
                $pages++;
            }
            
                $prev = $_POST['page'] - 1;
                $next = $_POST['page'] + 1;
                if($prev == 0){
                    echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>';
                }else{
                    echo '<li class="page-item">
                    <a class="page-link" href="#" tabindex="-1" onclick="return pagination('.$prev.','.$max.',true,\''.$_POST['sql'].'\')">Previous</a>
                </li>';
                }
                
                        for($i = 1; $i <= $pages; $i++){
                            if($i == $_POST['page']){
                                echo '<li class="page-item active"><a class="page-link" href="#" onclick="return pagination('.$i.','.$max.',true,\''.$_POST['sql'].'\')">'.$i.'</a></li>';
                            }else{
                                echo '<li class="page-item"><a class="page-link" onclick="return pagination('.$i.','.$max.',true,\''.$_POST['sql'].'\')">'.$i.'</a></li>';
                            }
                        }
                if($next <= $pages){
                    echo '<li class="page-item">
                    <a class="page-link" href="#" onclick="return pagination('.$next.','.$max.',true,\''.$_POST['sql'].'\')">Next</a>
                </li>';
                }else{
                    echo '<li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                    </li>';
                }
            
            
        }else{
            echo '<li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>';
                echo '<li class="page-item disabled"><a class="page-link">1</a></li>';
                echo '<li class="page-item disabled">
                        <a class="page-link" href="#">Next</a>
                    </li>';
        }


    }else if(isset($_POST['page'])){
        $max = $_POST['max'];
        $sql = "select user_id from users";
        $article = simpleQuery($sql);
        $total = count($article);
        $totalPages = intdiv($total, $max);
        $redundant = (int)$total % (int)$max;
        $pages = $totalPages;
        if($redundant > 0){
            $pages++;
        }
        $prev = $_POST['page'] - 1;
        $next = $_POST['page'] + 1;
            if($prev == 0){
                echo '<li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>';
            }else{
                echo '<li class="page-item">
                <a class="page-link" href="#" tabindex="-1" onclick="return pagination('.$prev.','.$max.',false)">Previous</a>
            </li>';
            }
            
                    for($i = 1; $i <= $pages; $i++){
                        if($i == $_POST['page']){
                            echo '<li class="page-item active"><a class="page-link" href="#" onclick="return pagination('.$i.','.$max.',false)">'.$i.'</a></li>';
                        }else{
                            echo '<li class="page-item"><a class="page-link" onclick="return pagination('.$i.','.$max.',false)">'.$i.'</a></li>';
                        }
                    }
            if($next <= $pages){
                echo '<li class="page-item">
                <a class="page-link" href="#" onclick="return pagination('.$next.','.$max.',false)">Next</a>
            </li>';
            }else{
                echo '<li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
            </li>';
        }
    }
    

?>