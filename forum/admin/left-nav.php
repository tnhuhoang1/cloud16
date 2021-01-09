<div class="h-ad-left-nav">
                    <ul>
                        <li><a class="h-ad-nav-ele <?php if($_SESSION['admin-path'] == 'forum') echo 'h-active'; ?>" href = "forum.php">Tong quan</a></li>
                        <li><a class="h-ad-nav-ele <?php if($_SESSION['admin-path'] == 'user') echo 'h-active'; ?>" href = "users.php">Quan li nguoi dung</a></li>
                        <li><a class="h-ad-nav-ele <?php if($_SESSION['admin-path'] == 'category') echo 'h-active'; ?>" href = "category.php">Quan li danh muc</a></li>
                        <li><a class="h-ad-nav-ele <?php if($_SESSION['admin-path'] == 'article') echo 'h-active'; ?>" href = "article.php">Quan li cau hoi</a></li>
                    </ul>
                </div>