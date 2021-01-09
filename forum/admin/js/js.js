function addCategory(){
    var conf = confirm("Ban that su muon them danh muc nay?");
    if(conf){
        var xml = new XMLHttpRequest();
        var txt = document.getElementById("admin-category");
        xml.onreadystatechange = function(){
            if(xml.status == 200 && xml.readyState == 4){
                if(this.responseText == "ok"){
                    txt.value = "";
                    loadCategory();
                }else if(this.responseText == "invalid"){
                    alert("Ten danh muc bi trung");
                }else{
                    alert("co loi xay ra");
                }
            }  
        }
        xml.open("POST","../../ajax/ad-add-category.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("add-category=&cate_title="+txt.value);
    }
    return false;
}

function resizeTitleWidth(it){
    if(it.value.length < 10){
        it.style.width = (it.value.length * 1.4) + "ch";
    }else{
        it.style.width = (it.value.length * 1.12345) + "ch";
    }
    
}
function loadSubCate(pos){
    var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                
                var container = document.getElementById("h-a-c-container");
                container.innerHTML = this.responseText;
                
            }
        }

    xml.open("POST","../../ajax/a-reload-subcate.php");
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
    xml.send("reload-sub=&cate_id="+pos);
    
}
function editCategory(pos){
    var id = document.getElementById("staticBackdropLabel1");
    id.setAttribute("data-id", pos.getAttribute("data-id"));
    var cateId = pos.getAttribute("data-id");
    loadSubCate(cateId);
    var xmls = new XMLHttpRequest();
        xmls.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                id.firstElementChild.firstElementChild.value = this.responseText;
                
                
            }
        }
    var cateId = pos.getAttribute("data-id");
    xmls.open("POST","../../ajax/ad-add-category.php");
    xmls.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
    xmls.send("get-cate-title=&cate_id="+cateId);
}
function changeSubCate(it){
    it.parentNode.parentNode.lastElementChild.firstElementChild.style.display = "block";
}

function updateSub(it){
    var subCateId = it.getAttribute("data-id");
    var txt = it.parentNode.parentNode.firstElementChild.nextElementSibling.firstElementChild.value;
    if(txt == ""){
        alert("Ten danh muc con k dc rong");
    }else{
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText == "error"){
                    alert("Co loi xay ra");
                }else if(this.responseText == "ok"){
                    it.style.display = "none";
                }else{
                    alert(this.responseText);
                }
            }
        }
        xml.open("POST","../../ajax/ad-add-category.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("update-sub=&sub_cate_id="+subCateId+"&title="+txt);
    }
}

function deleteSub(it){
    var conf = confirm("Ban co chac muon xoa danh muc nay");
    if(conf){
        var subCateId = it.getAttribute("data-id");
        
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText == "error"){
                    alert("Co loi xay ra");
                }else if(this.responseText == "ok"){
                    it.parentNode.parentNode.style.display = "none";
                    loadSubCate(subCateId);
                }else{
                    alert(this.responseText);
                }
            }
        }
        xml.open("POST","../../ajax/ad-add-category.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("delete-sub=&sub_cate_id="+subCateId);
        
    }
    
}

function addSubCategory(it){
    var cate_id = document.getElementById("staticBackdropLabel1").getAttribute("data-id");
    var conf = confirm("Ban that su muon them danh muc con nay?");
    if(conf){
        var title = it.parentNode.firstElementChild.value;
        if(title == ""){
            alert("Khong duoc de rong ten khi them vao");
        }else{
            var xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    if(this.responseText == "error"){
                        alert("Co loi xay ra");
                    }else if(this.responseText == "ok"){
                        loadSubCate(cate_id);
                        it.parentNode.firstElementChild.value = "";
                    }else{
                        alert(this.responseText);
                    }
                }
            }

            xml.open("POST","../../ajax/ad-add-category.php");
            xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
            xml.send("add_sub_cate=&cate_id="+cate_id+"&title="+title);
            }
        
    }
}
function updateCategory(it){
    var conf = confirm("Ban that su muon doi ten danh muc thanh \"" + it.firstElementChild.value +"\"");
    if(conf){
        var wait = document.getElementsByClassName("c-update-waiting")[0];
        wait.style.display = "inline-block";
        var ob = document.getElementById("staticBackdropLabel1");
        var id = ob.getAttribute("data-id");
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText == "error"){
                    alert("Co loi xay ra");
                }else if(this.responseText == "ok"){
                    setTimeout(() => {
                        wait.style.display = "none";
                        var suc = document.getElementsByClassName("c-update-success")[0];
                        suc.style.display = "inline-block";
                        setTimeout(()=>{
                        suc.style.display = "none";
                            
                        }, 1000)
                    }, 1500)
                }else{
                    alert(this.responseText);
                }
            }
        }

        xml.open("POST","../../ajax/ad-add-category.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("update-category=&cate_id="+id+"&title="+it.firstElementChild.value);
    }  
    return false;
}
function deleteCate(t,id){
    var conf = confirm("Ban co muon xoa danh muc nay khong");
    if(conf){
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText == "error"){
                    alert("Co loi xay ra");
                }else{
                    t.parentNode.parentNode.style.display = "none";
                }
            }
        }

        xml.open("POST","../../ajax/ad-add-category.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("del-category=&cate_id="+id);
    }
    
    
}

function loadCategory(){
    var xml = new XMLHttpRequest();
    var par = document.getElementById("h-ad-cate-con");
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            par.innerHTML  = "<div class='h-a-c-title'><div>STT</div><div class='h-a-c-row2'>"+
                "Ten danh muc"+
            "</div>"+
            "<div class='h-a-c-row3'>"+
                "So danh muc con"+
            "</div>"+
            "<div class='h-a-c-row4'>"+
            "EDIT"+
            "</div>"+
                
            "<div class='h-a-c-row5'>"+
                "DELETE"+
            "</div>"+
        "</div>";
            par.innerHTML = par.innerHTML + this.responseText;
        }
    }

    xml.open("GET","../../ajax/a-reload-category.php");
    xml.send();
}

function adEditArticle(id, u_id){
    var conf = confirm('Ban dong y dang bai nay?');
    if(conf){
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                var arCon = document.getElementById("adArticleCon");
                arCon.innerHTML = this.responseText;
            }
        }

        xml.open("POST","../../ajax/ad-article.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("a_edit=&a_id="+id+"&uid="+u_id);
    }
}

function adDeleteArticle(id){
    var conf = confirm('Ban co muon huy bai viet nay?');
    if(conf){
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                var arCon = document.getElementById("adArticleCon");
                arCon.innerHTML = this.responseText;
            }
        }

        xml.open("POST","../../ajax/ad-article.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("a_delete=&a_id="+id);
    }

}

function passUserId(it){
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var sel = document.getElementById("user-role-select");
            sel.innerHTML = this.responseText;
            var id_user = document.getElementById("id_user");
            id_user.value = it.getAttribute("data-id");
        }
    }

    xml.open("POST","../../ajax/a-edit-user.php");
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
    xml.send("a_editUser=&u_id="+it.getAttribute("data-id"));
}
// var xml = new XMLHttpRequest();
// xml.onreadystatechange = function(){
//     if(this.readyState == 4 && this.status == 200){

//     }
// }

// xml.open("POST","../../ajax/ad-add-category.php");
// xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
// xml.send("add-category=&cate_title="+txt.value);