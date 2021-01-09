function adminLogin(it){
    // document.getElementById().fi
    var username = it.firstElementChild;
    var password = username.nextElementSibling;
    if(username.value == "" || password.value == ""){
        alert("Tai khoan hoac mat khau khong duoc de trong");
    }else{
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
               if(this.responseText == "ok"){
                    location.replace("main.php");
               }else{
                   alert(this.responseText);
               }
            }
        }
        xml.open("POST", "ajax/a-ad-login.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("adLogin=&username="+username.value+"&password="+password.value);

    }

    return false;
}

function adAddCategory(it){
    var title = it.firstElementChild.firstElementChild;
    if(title.value == ""){
        alert("Ten danh muc k dc de trong");
    }else{
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
               if(this.responseText == "ok"){
                    location.replace("category.php");
               }else{
                   alert(this.responseText);
               }
            }
        }
        xml.open("POST", "ajax/a-ad-category.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("addCategory=&title="+title.value);

    }
    return false;
}


function adAddSubCategory(it){
    var title = it.firstElementChild.firstElementChild;
    var c_id = document.getElementById('cateList').value;
    if(title.value == ""){
        alert("Ten danh muc k dc de trong");
    }else{
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
               if(this.responseText == "ok"){
                    location.replace("category.php");
               }else{
                   alert(this.responseText);
               }
            }
        }
        xml.open("POST", "ajax/a-ad-category.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("addSubCategory=&title="+title.value +"&c_id="+c_id);

    }
    return false;
}

function adDeleteCategory(id){
    var conf = confirm("Ban co chac chan muon xoa k");
    if(conf){
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText == "ok"){
                    location.replace("category.php");
                }else{
                    alert(this.responseText);
                }
            }
        }
        xml.open("POST", "ajax/a-ad-category.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("deleteCategory=&id="+id);
    }   
    return false;
}

function adDeleteSubCategory(id){
    
    var conf = confirm("Ban co chac chan muon xoa k");
    if(conf){
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText == "ok"){
                    location.replace("category.php");
                }else{
                    alert(this.responseText);
                }
            }
        }
        xml.open("POST", "ajax/a-ad-category.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("deleteSubCategory=&id="+id);
    }   
    return false;
}

function loadToEditCate(id){
    var container = document.getElementById("adEditCategory");
    var title = container.firstElementChild.firstElementChild;
    var submit = container.firstElementChild.nextElementSibling.firstElementChild;
    var xml = new XMLHttpRequest();
    xml.responseType = "json";
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var data = this.response;
            title.value = data[0]['title'];
            submit.value = data[0]['cate_id'];
        }
    }
    xml.open("POST", "ajax/a-ad-category.php");
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
    xml.send("loadCategory=&id="+id);
}

function adEditCategory(it){
    var title = it.firstElementChild.firstElementChild.value;
    var id = it.firstElementChild.nextElementSibling.firstElementChild.value;
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == "ok"){
                location.replace("category.php");
            }else{
                alert(this.responseText);
            }
        }
    }
    xml.open("POST", "ajax/a-ad-category.php");
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
    xml.send("editCategory=&cate_id="+id+"&title="+title);
    return false;
}

function loadToEditSubCate(id){
    var container = document.getElementById("adEditSubCategory");
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            container.innerHTML = this.responseText;
        }
    }
    xml.open("POST", "ajax/a-ad-category.php");
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
    xml.send("loadSubCategory=&id="+id);
}

function adEditSubCategory(it){
    var title = it.firstElementChild.firstElementChild.value;
    var cateId = it.firstElementChild.nextElementSibling.firstElementChild.value;
    var id = it.firstElementChild.nextElementSibling.nextElementSibling.firstElementChild.value;
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == "ok"){
                location.replace("category.php");
            }else{
                alert(this.responseText);
            }
        }
    }
    xml.open("POST", "ajax/a-ad-category.php");
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
    xml.send("editSubCategory=&cate_id="+cateId+"&title="+title+"&id="+id);
    return false;
}


function changeCate(it){

    var cate_id = it.value;
    var subCate = document.getElementById("adSubCateList");
    if(cate_id == 0){
        subCate.innerHTML = '<option value="0" selected>--- select ---</option>';
    }else{
        
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                subCate.innerHTML = this.responseText;
            }
        }
        xml.open("POST", "ajax/a-ad-category.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("changeCate=&cate_id="+cate_id);
    }
    
}

function adEditArticle(){
    alert("Hay xoa di va them moi lai bai viet");
}

function adDeleteArticle(id){
    let conf = confirm("ban co chac la muon xoa k");
    if(conf){
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.readyState == 4 && this.status == 200){
                    if(this.responseText == "ok"){
                        location.replace("article.php");
                    }else{
                        alert(this.responseText);
                    }
                }
            }
        }
        xml.open("POST", "ajax/a-ad-category.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("adEditArticle=&id="+id);
    }
}

function adminDelete(id){

    let xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText == "ok"){
                    location.replace("main.php");
                }else{
                    alert(this.responseText);
                }
            }
        }
    }
    xml.open("POST", "ajax/a-ad-category.php");
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
    xml.send("adminDelete=&id="+id);
}