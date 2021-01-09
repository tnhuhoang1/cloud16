<div class="row h-footer" >
    <div class="col-md-3">
        <div class="h-footer-address">
            <h5>Khoa cong nghe thong tin</h5>
            <div class="h-f-a-detail">
                <h6>Dia chi</h6>
                <p>TẦNG 2 NHÀ C1, 175 TÂY SƠN, QUẬN ĐỐNG ĐA, THÀNH PHỐ HÀ NỘI</p>
            </div>
            <div class="h-f-a-detail">
                <h6>Dien thoai</h6>
                <p>(04) 35632211</p>
            </div>
            <div class="h-f-a-detail">
                <h6>Fax</h6>
                <p>(04) 3563 3351</p>
            </div>
            <div class="h-f-a-detail">
                <h6>Email</h6>
                <p>vpkcntt@tlu.edu.vn</p>
            </div>
        </div>
        
    </div>
    <div class="col-md-3">
        <ul class="h-footer-nav">
            <?php
                $sql = "select * from sub_category where cate_id = 3";
                $subCate = simpleQuery($sql);
                foreach($subCate as $v){
                    echo '<li class="h-li"><a href="posts.php?cate_id=3&sub_cate_id='.$v['sub_cate_id'].'" class="h-a">'.$v['title'].'</a></li>';
                }
            ?>
        </ul>
    </div>
    <div class="col-md-3">
        <ul class="h-footer-nav">
            <?php
                $sql = "select * from sub_category where cate_id = 4";
                $subCate = simpleQuery($sql);
                foreach($subCate as $v){
                    echo '<li class="h-li"><a href="posts.php?cate_id=4&sub_cate_id='.$v['sub_cate_id'].'" class="h-a">'.$v['title'].'</a></li>';
                }
            ?>
        </ul>
    </div>
    <div class="col-md-3 h-fb-plugin">
        <!-- facebook fanpage -->
        <div class="fb-page" data-href="https://www.facebook.com/cse.tlu.edu.vn/" data-tabs="event" data-width="180" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/cse.tlu.edu.vn/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/cse.tlu.edu.vn/">Khoa Công nghệ thông tin- Đại học Thủy lợi</a></blockquote></div>
        <!-- //facebook fanpage -->
    </div>
</div>
<div class="row h-footer-copyright">
    <div class="col-sm-9 h-f-c-title">
        <h6>Copyright &copy 2020 CSE TLU. All rights reserved.</h6>
    </div>
    <div class="col-sm-3">
        <div class="h-contact-icon"><a href="admin/index.php"><i class="fas fa-users-cog"></i></a></div>
        <div class="h-contact-icon"><a href="#"><i class="fa fa-facebook"></i></a></div>
        <div class="h-contact-icon"><a href="#"><i class="fa fa-youtube"></i></a></div>
        <div class="h-contact-icon"><a href="#"><i class="fa fa-twitter"></i></a></div>
    </div>
</div>