<div class="col-sm h-navbar" id="h-main-navbar">
    <header>
        
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand h-nav-brand" href="index.php">
                <img src="images/logo.jpg" alt="logo" class="img-fluid">  
            </a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    
                    <?php
                    require_once("./admin/database-function.php");
                    $sql = "select * from category where level = 5";
                    $cate = simpleQuery($sql);
                    foreach($cate as $v){
                        echo '<li class="nav-item active dropdown h-nav-item">';
                            $sql = "select * from sub_category where cate_id = ?";
                            $subCate = simpleQuery($sql, 1, [$v['cate_id']]);
                            if(count($subCate) > 0){
                                echo '<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">'.$v['title'].'</a>
                                <div class="dropdown-menu">';
                                    foreach($subCate as $b){
                                        echo '<a class="dropdown-item" href="posts.php?cate_id='.$b['cate_id'].'&sub_cate_id='.$b['sub_cate_id'].'">'.$b['title'].'</a>';
                                    }
                                echo '</div>';
                            }else{
                                echo '<a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">'.$v['title'].'</a>';
                            }
                            
                            
                        echo '</li>';
                    }
                    
                    ?>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Tuyen Sinh</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">Sinh Vien</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Tai Lieu sinh vien</a>
                            <a class="dropdown-item" href="#">To tu van hoc tap</a>
                            <a class="dropdown-item" href="#">Bieu mau</a>
                            <a class="dropdown-item" href="#">Luan van tot nghiep</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cuu Sinh Vien</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="true">Nghien cuu Khoa Hoc</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Cac de tai du an</a>
                            <a class="dropdown-item" href="#">Thong tin seminar</a>
                            <a class="dropdown-item" href="#">Cong trinh cong bo</a>
                            <a class="dropdown-item" href="#">Cac phong thi nghiem</a>
                        </div>
                    </li> -->
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search"> -->
                    <span id="h-search-button" onclick="toggleSearch()"><i class="fas fa-search"></i></span>
                </form>
                <!-- seach box -->
                <?php include("searchBox.php") ?>

                <!-- //search box -->
            </div>
        </nav>

    </header>
</div>