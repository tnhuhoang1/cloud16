<div class="h-search-slide" id="h-slide-search">
    <div class="h-search-exit">
        <button class="h-exit-button" onclick="closeSearchBox()">&times</button>
    </div>
    <div class="h-search-box">
        <form class="form-inline my-2 my-lg-0" onsubmit="return false">
            <input class="form-control mr-sm-2" id="searchInput" type="text" placeholder="Search">
            <a href="#" id="h-search-button" onclick="slideSearch()"><i class="fas fa-search"></i></a>
            <input type="submit" onclick="slideSearch()" style="display:none;">
        </form>
    </div>
    <div class="h-search-result">
        <div class="h-s-r-found" id="searchFound">
            
            
            
        </div>
        
    </div>
    <div class="h-search-recent" id="searchRecent">
        <p class="h-s-r-title">Gan day</p>
        <?php
            if(isset($_SESSION['recentSearch'])){
                foreach($_SESSION['recentSearch'] as $v){
                    echo '<p class="h-s-r-text"><a href="#" class="h-a" onclick="slideSearch(\''.$v.'\')">- '.$v.'</a></p>';
                }
            }
        ?>
        
    
    </div>
</div>