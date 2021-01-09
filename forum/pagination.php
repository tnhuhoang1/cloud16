
<?php
function pagination(bool $first,int $p, int $max, string $url){
    if($first){
        $page = 1;
        $sql = "select article_id from articles where is_publish = 0";
        $article = simpleQuery($sql);
        $total = count($article);
        $totalPages = intdiv($total, $max);
        $redundant = (int)$total % (int)$max;
        $pages = $totalPages;
        if($redundant > 0){
            $pages++;
        }
        
        echo '<nav aria-label="main pagination">
        <ul class="pagination justify-content-center h-pagination">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>';
                for($i = 1 ; $i <= $pages; $i++){
                    if($i <= 5){
                        if($i == 1){
                            echo '<li class="page-item active"><a class="page-link" href="'.$url.'?page='.$i.'&max='.$max.'">'.$i.'</a></li>';
                        }else{
                            echo '<li class="page-item"><a class="page-link" href="'.$url.'?page='.$i.'&max='.$max.'">'.$i.'</a></li>';
                        }
                    }else{
                        if($i == $pages){
                            echo '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
                            echo '<li class="page-item"><a class="page-link" href="'.$url.'?page='.$i.'&max='.$max.'">'.$i.'</a></li>';
                        }else{
                            continue;
                        }
                    }
                    
                    
                    
                }
                

            
            echo '<li class="page-item">
                <a class="page-link" href="'.$url.'?page=';echo $page+1; echo '&max='.$max.'">Next</a>
            </li>
        </ul>
        </nav>';
    }else{
        $sql = "select article_id from articles where is_publish = 0";
        $article = simpleQuery($sql);
        $total = count($article);
        $totalPages = intdiv($total, $max);
        $redundant = (int)$total % (int)$max;
        $pages = $totalPages;
        if($redundant > 0){
            $pages++;
        }
        
        echo '<nav aria-label="main pagination">
        <ul class="pagination justify-content-center h-pagination">';
            if($p > 1){
                echo '<li class="page-item">';
                
            }else{
                echo '<li class="page-item disabled">';
            }
            
                echo '<a class="page-link" href="'.$url.'?page=';
                echo $p-1;
                echo '&max='.$max.'" tabindex="-1">Previous</a>
            </li>';
                for($i = 1 ; $i <= $pages; $i++){
                    if($i <= 5){
                        if($i == $p){
                            echo '<li class="page-item active"><a class="page-link" href="'.$url.'?page='.$i.'&max='.$max.'">'.$i.'</a></li>';
                        }else{
                            echo '<li class="page-item"><a class="page-link" href="'.$url.'?page='.$i.'&max='.$max.'">'.$i.'</a></li>';
                        }
                    }else{
                        if($i == $pages){
                            echo '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
                            echo '<li class="page-item"><a class="page-link" href="'.$url.'?page='.$i.'&max='.$max.'">'.$i.'</a></li>';
                        }else{
                            continue;
                        }
                    }
                    
                    
                    
                }
                

            if($p == $pages){
                echo '<li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
            </li>';
            }else{
                echo '<li class="page-item">
                <a class="page-link" href="'.$url.'?page=';echo $p+1; echo '&max='.$max.'">Next</a>
            </li>';
            }
            
        echo '</ul>
        </nav>';
    }
}


?>