<div class="row h-main-row h-nav-top" >
                    <?php
                        if(isset($_SESSION['path'])){
                            if($_SESSION['path'] == 'home'){
                                echo '<div ><a href="forum.php" class="h-a"><i class="fas fa-home"></i></a></div>';
                            }else if($_SESSION['path'] == 'article'){
                                echo '<div ><a href="forum.php" class="h-a"><i class="fas fa-home"></i></a><i class="fas fa-chevron-right"></i><span> Bai viet</span></div>';

                            }else if($_SESSION['path'] == 'category'){
                                echo '<div ><a href="forum.php" class="h-a"><i class="fas fa-home"></i></a><i class="fas fa-chevron-right"></i><span> Danh muc</span></div>';

                            }else if($_SESSION['path'] == 'info'){
                                echo '<div ><a href="forum.php" class="h-a"><i class="fas fa-home"></i></a><i class="fas fa-chevron-right"></i><span> Thong tin</span></div>';

                            }else if($_SESSION['path'] == 'member'){
                                echo '<div ><a href="forum.php" class="h-a"><i class="fas fa-home"></i></a><i class="fas fa-chevron-right"></i><span> Thanh vien</span></div>';
                            }else if($_SESSION['path'] == 'quest'){
                                echo '<div ><a href="forum.php" class="h-a"><i class="fas fa-home"></i></a><i class="fas fa-chevron-right"></i><span> Tao cau hoi</span></div>';

                            }else if($_SESSION['path'] == 'sub_cate'){
                                echo '<div ><a href="forum.php" class="h-a"><i class="fas fa-home"></i></a><i class="fas fa-chevron-right"></i><span> Danh muc con</span></div>';

                            }
                        }else{
                            echo '<div ><a href="forum.php" class="h-a"><i class="fas fa-home"></i></a></div>';
                        }
                    ?>
                    <?php
                                    // if(isset($_SESSION['waiting']) && $_SESSION['waiting'] == 1){
                                    //     echo '<div class="row h-waiting-alert">
                                    //     <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    //         <strong>Bai cua ban da duoc gui den admin de cho duyet, vui long doi!</strong>
                                    //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    //             <span aria-hidden="true">&times;</span>
                                    //         </button>
                                    //     </div>
                                    //     </div>';
                                    //     unset($_SESSION['waiting']);
                                    // }
                                    
                                    ?>
                </div>