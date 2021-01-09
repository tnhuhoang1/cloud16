<?php
    session_start();
    if(isset($_SESSION['status']) && $_SESSION['role'] == 1){
    }else{
        header("location: ../../forum.php");
    }
    require_once("../../database/database-function.php");
    $_SESSION['admin-path'] = 'category';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORUM HQ</title>

    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/9b1d6678e4.js" crossorigin="anonymous"></script>
    <!-- //font awesome -->
    <!-- CSS only -->
    <!-- boostrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- //boostrap CDN -->

    <link rel="stylesheet" href="css/style.css">


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
</head>
<body>

    <!-- Modal -->
    <div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered h-modal-center modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel1">Chinh sua danh muc <form onsubmit="return updateCategory(this)" style="display:inline"><input type="text" class ="h-ad-in-title" value="Title" oninput="resizeTitleWidth(this)">
                    <input type="submit" style="display:none"></form>
                    <div class="spinner-border text-success c-update-waiting" role="status">
                        <span class="sr-only"></span>
                    </div>
                    <i class="fas fa-check-circle c-update-success" style="font-size: 1.65em; color: green"></i>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="loadCategory()">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="h-ad-add">
                        <form action="" onsubmit="return false">
                            <input type="text" placeholder="ten danh muc">
                            <button type="submit" onclick="addSubCategory(this)">Them danh muc con</button>
                        </form>
                    </div>
                    <div class="h-ad-subcate">
                        <div class="h-a-content">
                                <div class="h-a-c-title">
                                    <div class="h-a-c-row1">
                                        STT
                                    </div>
                                    <div class="h-a-c-row2">
                                        Ten danh muc
                                    </div>
                                
                                    <div class="h-a-c-row4">
                                        DELETE
                                    </div>
                                        
                                    <div class="h-a-c-row5">
                                        
                                    </div>
                                </div>

                                <div class = "h-a-c-container" id = "h-a-c-container">
                                    <!-- <div class="h-a-c-empty">
                                        K co danh muc con
                                    </div> -->
                                    <div class="h-a-c-content">
                                        <div class="h-a-c-row1">
                                            1
                                        </div>
                                        <div class="h-a-c-row2">
                                            <input type="text" class="h-sub-text" value="hoang" onchange="changeSubCate">
                                        </div>
                                    
                                        <div class="h-a-c-row4">
                                            <a href="#"><i class="fas fa-trash-alt"></i></a>    
                                        </div>
                                        
                                        <div class="h-a-c-row5">
                                            <a href="#"><i class="fas fa-check"></i></a>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                
                            </div>
                        </div>

                    </div>

                </div>
                
            </div>
        </div>
    </div>




    <div class="container-fluid">
        <div class="row h-ad-logo">
        <?php
                include_once('admin-topbar.php');
            ?>
            <div class="col-9">
                <div>
                    <h4>Quan li danh muc</h4>
                </div>
            </div>
            

        </div>
        <div class="row">
            <div class="col-3 h-ad-left-sec">
            <?php
                include_once("left-nav.php");

            ?>
            </div>
            <div class="col-9 h-ad-right-sec">
                <div>
                    <div class="h-a-control">

                    </div>
                    <div class="h-a-content" id ="h-ad-cate-con">
                        <div class="h-a-c-title">
                            <div>
                                STT
                            </div>
                            <div class="h-a-c-row2">
                                Ten danh muc
                            </div>
                            <div class="h-a-c-row3">
                                So danh muc con
                            </div>
                            <div class="h-a-c-row4">
                            EDIT
                            </div>
                                
                            <div class="h-a-c-row5">
                                DELETE
                            </div>
                        </div>
                        
                        <?php
                            $sql = "select cate_id,title from categoris";
                            $record = simpleQuery($sql);
                            $i = 1;
                            foreach($record as $v){
                                echo '<div class="h-a-c-content">
                                <div>';
                                    echo $i;
                                echo '</div>
                                <div class="h-a-c-row2">';
                                    echo $v['title'];
                                echo '</div>
                                <div class="h-a-c-row3">';
                                    $sql = "select sub_cate_id from sub_categoris where cate_id = ?";
                                    $temp = simpleQuery($sql,1,[$v['cate_id']]);
                                    echo count($temp);
                                echo '</div>
                                <div class="h-a-c-row4">
                                    <a href="#" role="button" data-toggle="modal" data-target="#modalEdit" data-id = "';echo $v['cate_id']; echo '" onclick="editCategory(this)"><i class="fas fa-edit"></i></a>    
                                </div>
                                    
                                <div class="h-a-c-row5">
                                    <a href="#" onclick = "deleteCate(this,'; echo $v['cate_id']; echo ')"><i class="fas fa-trash-alt"></i></a>
                                </div>
                                </div>';
                                $i++;
                            }
                        ?>
                    </div>
                </div>
                <div class="h-ad-cate-controler">
                    <form onsubmit="return addCategory()">
                        <input type="text" id = "admin-category" placeholder="Ten danh muc" required>
                        <input type="submit" value="Them danh muc" class="h-add-cate">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/js.js"></script>
</body>
</html>