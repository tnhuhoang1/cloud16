<div class="h-most-asked">
<div class="h-m-a-title">
    <h4>Các câu hỏi nổi bật</h4>
</div>
<?php
    require_once("./database/database-function.php");
    $s = "select count(like_action.user_id) as slLike, like_action.article_id, articles.title, articles.create_at from articles, like_action WHERE articles.article_id = like_action.article_id and articles.is_publish = 0 GROUP BY like_action.article_id order by count(like_action.user_id) desc limit 5";
    $article = simpleQuery($s);
    foreach($article as $v){
        $articleDate = date_format(date_create($v['create_at']), 'd/m/Y');
        echo '<div class="h-m-a-post">
            <h6><a href="forum-article.php?article_id='.$v['article_id'].'" class="h-a">'.$v['title'].'</a></h6>
            <p>'.$articleDate.'</p>
        </div>';
    }
?>


</div>