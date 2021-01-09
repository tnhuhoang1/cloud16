<?php
    $sqls = "select * from slide order by slide_id desc limit 5";
    $slide = simpleQuery($sqls);
    if(count($slide) > 0){
        echo '<div class="carousel slide carousel-fade" data-ride="carousel" id="main-carousel">
            <div class="carousel-inner">';
                $i = 1;
                foreach($slide as $v){
                    $sql = "select cate_id, article.sub_cate_id, article_id from article, sub_category where article.sub_cate_id = sub_category.sub_cate_id and article_id = ?";
                    $article = simpleQuery($sql,1,[$v['article_id']]);
                    if($i == 1){
                        echo '<div class="carousel-item active h-carousel-item" data-interval="4000">
                            <a href="post.php?cate_id='.$article[0]['cate_id'].'&sub_cate_id='.$article[0]['sub_cate_id'].'&ar_id='.$article[0]['article_id'].'"><img class="d-block h-carousel-image" src="admin/'.$v['img'].'" alt="i1"></a>
                        </div>';
                    }else{
                        echo '<div class="carousel-item h-carousel-item" data-interval="4000">
                            <a href="post.php?cate_id='.$article[0]['cate_id'].'&sub_cate_id='.$article[0]['sub_cate_id'].'&ar_id='.$article[0]['article_id'].'"><img class="d-block h-carousel-image" src="admin/'.$v['img'].'" alt="i1"></a>
                        </div>';
                    }
                    $i++;
                }
                
                
            echo '</div>
        
            <!-- controler -->
            <a class="carousel-control-prev" href="#main-carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                
            </a>
            <a class="carousel-control-next" href="#main-carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                
            </a>
        </div>';
    }


?>