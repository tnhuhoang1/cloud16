<?php
    session_start();
    require_once("./database-function.php");
    if(!isset($_SESSION['cse-username']) || !isset($_SESSION['cse-role'])){
        header("location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>

    <!-- Font -->
    <?php
        include("../includes/fonts.php")
    ?> 
    <!-- //font -->

    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/9b1d6678e4.js" crossorigin="anonymous"></script>
    <!-- //font awesome -->
    <!-- CSS only -->
    <!-- boostrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- //boostrap CDN -->
    <!-- my css -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- //my scc -->



    <!-- JS, Popper.js, and jQuery -->
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</head>
<body class="bg-dark">
    <div class="container-fluid main-container">
        <div class="row">
            <?php
                include_once("admin-nav.php");
            ?>
        </div>
        <div class="row h-row-main">
            <div class="h-main-content">
                <div style="border-bottom: 1px solid gray;">
                    <h4>Quan li danh muc</h4>
                </div>
                <div>
                    <button class="h-btn h-btn-adduser" data-toggle="modal" data-target="#categoryModal">Them danh muc</button>
                </div>

                <div class="h-flex-verticle h-cate-title h-title">
                    <div>STT</div>
                    <div>Ten danh muc</div>
                    <div>Sua</div>
                    <div>Xoa</div>

                </div>
                <?php
                    $sql = "select * from category";
                    $cate = simpleQuery($sql);
                    if(count($cate) > 0){
                        $i = 1;
                        foreach($cate as $v){
                            echo '<div class="h-flex-verticle h-cate-content h-content">
                            <div>'.$i.'</div>
                            <div>'.$v['title'].'</div>
                            <div><i class="fas fa-edit" data-toggle="modal" data-target="#editCategoryModal" onclick="loadToEditCate('.$v['cate_id'].')"></i></div>
                            <div><i class="fas fa-trash" onclick="return adDeleteCategory('.$v['cate_id'].')"></i></div>

                        </div>';
                        $i++;
                        }
                        
                    }else{
                        echo '<div style="width:100%;">K co danh muc nao</div>';
                    }
                    
                
                ?>
                <!-- Modal -->
                <div class="modal fade" id="categoryModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Them danh muc</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body h-modal">
                        <form action="" method="POST" onsubmit="return adAddCategory(this)">
                            <div>
                                <input type="text" placeholder="Ten danh muc">
                            </div>
                            <div>
                                <button type='submit' name="addCategory" >Them</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="editCategoryModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Sua danh muc</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body h-modal">
                        <form action="" method="POST" id="adEditCategory" onsubmit="return adEditCategory(this)">
                            <div>
                                <input type="text" placeholder="Ten danh muc">
                            </div>
                            <div>
                                <button>Sua</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="subCategoryModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Them danh muc con</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body h-modal">
                        <form action="" method="POST" onsubmit="return adAddSubCategory(this)">
                            <div>
                                <input type="text" placeholder="Ten danh muc">
                            </div>
                            <div>
                                <select id="cateList">
                                    <?php
                                        $sql = "select * from category";
                                        $cate = simpleQuery($sql);
                                        $i = 1;
                                        foreach($cate as $v){
                                            if($i == 1){
                                                echo '<option value="'.$v['cate_id'].'" selected>'.$v['title'].'</option>';
                                            }else{
                                                echo '<option value="'.$v['cate_id'].'">'.$v['title'].'</option>';
                                            }
                                            $i++;
                                        }
                                    ?>
                                    
                                </select>
                            </div>
                            <div>
                                <button>Them</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                    </div>
                </div>
                </div>

                
                <!-- Modal -->
                <div class="modal fade" id="editSubCategoryModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Sua danh muc con</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body h-modal">
                        <form action="" method="POST" id="adEditSubCategory" onsubmit="return adEditSubCategory(this)">
                            <div>
                                <input type="text" placeholder="Ten danh muc">
                            </div>
                            <div>
                                <select id="cateListEdit">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div>
                                <button>Sua</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="slide" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body h-modal">
                        <form action="" method="POST">
                            <div>
                                <input type="text" placeholder="Tieu de cua slide">
                            </div>
                            <div>
                                <input type="file" placeholder="Anh">
                            </div>
                            <div>
                                <input type="text" placeholder="Link du phong">
                            </div>
                            <div>
                                <button>Them</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="editSlide" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body h-modal">
                        <form action="" method="POST">
                            <div>
                                <input type="text" placeholder="Tieu de cua slide">
                            </div>
                            <div>
                                <input type="file" placeholder="Anh">
                            </div>
                            <div>
                                <input type="text" placeholder="Link du phong">
                            </div>
                            <div>
                                <button>Them</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="event" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body h-modal">
                        <form action="" method="POST">
                            <div>
                                <input type="text" placeholder="Tieu de cua slide">
                            </div>
                            <div>
                                <input type="file" placeholder="Anh">
                            </div>
                            <div>
                                <input type="text" placeholder="Link du phong">
                            </div>
                            <div>
                                <button>Them</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="editEvent" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body h-modal">
                        <form action="" method="POST">
                            <div>
                                <input type="text" placeholder="Tieu de cua slide">
                            </div>
                            <div>
                                <input type="file" placeholder="Anh">
                            </div>
                            <div>
                                <input type="text" placeholder="Link du phong">
                            </div>
                            <div>
                                <button>Them</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Understood</button>
                    </div>
                    </div>
                </div>
                </div>
                <!-- <div class="" data-toggle="buttons">
                    <div>
                        <label class="btn btn-primary active">
                            <input type="checkbox" name="" id="" checked autocomplete="off">
                        </label>
                    </div>
                    <div>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="" id="" autocomplete="off">
                        </label>
                    </div>
                    <div>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="" id="" autocomplete="off">
                        </label>
                    </div>
                    
                </div> -->
                <div style="border-bottom: 1px solid gray; margin-top: 10px">
                    
                </div>
                <div>
                <button class="h-btn h-btn-adduser" data-toggle="modal" data-target="#subCategoryModal">Them danh muc</button>
                </div>

                <div class="h-flex-verticle h-sub-cate-title h-title">
                    <div>STT</div>
                    <div>Ten danh muc con</div>
                    <div>Thuoc danh muc</div>
                    <div>Sua</div>
                    <div>Xoa</div>

                </div>
                    <?php
                        $sql = "select s.title as title,s.sub_cate_id, s.cate_id, c.title as cate_title from sub_category as s, category as c where s.cate_id = c.cate_id";
                        $subCate = simpleQuery($sql);
                        if(count($subCate) > 0){
                            $i = 1;
                            foreach($subCate as $v){
                                echo '<div class="h-flex-verticle h-sub-cate-content h-content">
                                <div>'.$i.'</div>
                                <div>'.$v['title'].'</div>
                                <div>'.$v['cate_title'].'</div>
                                <div><i class="fas fa-edit" data-toggle="modal" data-target="#editSubCategoryModal" onclick="loadToEditSubCate('.$v['sub_cate_id'].')"></i></div>
                                <div><i class="fas fa-trash" onclick="return adDeleteSubCategory('.$v['sub_cate_id'].')"></i></div>
                                </div>';
                                $i++;
                            }
                        }else{
                            echo '<div class="h-flex-verticle h-sub-cate-content h-content">
                            <div style="width:100%;">Chua co danh muc con nao</div>
                            </div>';
                        }
                        
                    ?>
                
                    

                


                <div style="border-bottom: 1px solid gray; margin-top: 10px">
                    
                </div>
                <div>

                <!-- <button class="h-btn h-btn-adduser" data-toggle="modal" data-target="#slide">Them slide</button>
                </div>

                <div class="h-flex-verticle h-sub-cate-title h-title">
                    <div>STT</div>
                    <div>Ten danh muc con</div>
                    <div>Thuoc danh muc</div>
                    <div>Sua</div>
                    <div>Xoa</div>

                </div>
                <div class="h-flex-verticle h-sub-cate-content h-content">
                    <div>STT</div>
                    <div>Ten nguoi dung</div>
                    <div>SDT</div>
                    <div><i class="fas fa-edit"></i></div>
                    <div><i class="fas fa-trash"></i></div>

                </div>

                <div style="border-bottom: 1px solid gray; margin-top: 10px">
                </div>
                <div>
                    <button class="h-btn h-btn-adduser" data-toggle="modal" data-target="#event">Them su kien</button>
                </div>

                <div class="h-flex-verticle h-sub-cate-title h-title">
                    <div>STT</div>
                    <div>Ten danh muc con</div>
                    <div>Thuoc danh muc</div>
                    <div>Sua</div>
                    <div>Xoa</div>

                </div>
                <div class="h-flex-verticle h-sub-cate-content h-content">
                    <div>STT</div>
                    <div>Ten nguoi dung</div>
                    <div>SDT</div>
                    <div><i class="fas fa-edit"></i></div>
                    <div><i class="fas fa-trash"></i></div>

                </div> -->
            </div>
        </div>
    </div>
    
    




    

    <script src="js/js.js">
    </script>
</body>


</html>