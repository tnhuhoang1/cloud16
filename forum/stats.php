<div class="h-member">
    <?php

    $s = "select count(article_id) as sl from articles";
    $slAr = simpleQuery($s);
    $s = "select count(user_id) as sl from users";
    $slU = simpleQuery($s);
    echo '<div><a>So thanh vien: </a><span>'.$slU[0]['sl'].'</span></div>
    <div><a>Tong so bai: </a><span>'.$slAr[0]['sl'].'</span></div>';
    ?>
    

</div>