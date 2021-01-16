<div class="h-member">
    <?php

    $s = "select count(article_id) as sl from articles";
    $slAr = simpleQuery($s);
    $s = "select count(user_id) as sl from users";
    $slU = simpleQuery($s);
    echo '<div><a>số thành viên: </a><span>'.$slU[0]['sl'].'</span></div>
    <div><a>Tổng số bài: </a><span>'.$slAr[0]['sl'].'</span></div>';
    ?>
    

</div>