$(document).ready(function(){
    // $(".h-reply").click(function(){
    //     $(".h-comment-log").slideToggle();
            
    // });

});
function showCommentBox(it){
    // alert(it.classList);
    it.firstElementChild.classList.toggle("on");  
    var com = document.getElementById("log-comment-"+ it.getAttribute("data-id"));
    com.classList.toggle("h-comment-slide-on");
    $(document).ready(function(){
 
        if(it.firstElementChild.classList.contains("on")){
            $(".h-comment-slide-on").slideDown();
            com.classList.toggle("h-comment-slide-on");
            it.firstElementChild.classList.toggle("far", false);
            it.firstElementChild.classList.toggle("fas",true);

        }else{
            $(".h-comment-slide-on").slideUp();
            com.classList.toggle("h-comment-slide-on");
            it.firstElementChild.classList.toggle("far", true);
            it.firstElementChild.classList.toggle("fas",false);
        } 
    });
}

function onLikeClick(it,a_id, u_id){
    var like = it.firstElementChild.nextElementSibling;
    var num = it.firstElementChild;
    like.classList.toggle("on");  
    
    if(like.classList.contains("on")){
        like.classList.toggle("far", false);
        like.classList.toggle("fas",true);
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                num.innerHTML = this.responseText;
            }
        }
        xml.open("POST", "ajax/a-like.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("like_action=&article_id="+a_id+"&user_id="+u_id);

    }else{
        like.classList.toggle("far", true);
        like.classList.toggle("fas",false);
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText == "0"){
                    num.innerHTML = "";
                }else{
                    num.innerHTML = this.responseText;
                }
                
            }
        }
        xml.open("POST", "ajax/a-like.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("unlike_action=&article_id="+a_id+"&user_id="+u_id);
    } 
        
    
    return false;
}

function quickComment(it,a_id,u_id){
    var commentTxt = it.firstElementChild;
    if(commentTxt.value == ""){
        return false;
    }else{
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                var commentCon = it.parentNode.parentNode.firstElementChild;
                commentCon.innerHTML = this.responseText;
                commentTxt.value = "";
            }
        }
        xml.open("POST", "ajax/a-comment.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("quick_comment=&content="+commentTxt.value+"&article_id="+a_id+"&user_id="+u_id);
    }

    return false;
}
// validate register form
function resCheck(){
    var username = document.getElementById("res-username");
    var val = username.value;
    var password = document.getElementById("res-password").value;
    var passwordConfirm = document.getElementById("res-password-confirm").value;
    if(val.search(/\W/i) == "" || val.search(/\W/i) >=0){
        alert("Username k duoc chua ki tu dac biet");
        return false;
    }else if(password != passwordConfirm){
        alert("Nhap lai password bi sai");
        return false;
    }else{
        var xmlhttp = new XMLHttpRequest();
        var email = document.getElementById("res-email");
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var errors = document.getElementById("h-res-errors");
                if(this.responseText == 'ok'){
                    var xml = new XMLHttpRequest();
                    var resBtn = "";
                    xml.onreadystatechange = function(){
                        if(this.readyState == 4 && this.status == 200){
                            var al = document.getElementById("h-full-alert");
                            if(this.responseText == "error"){
                                
                                al.firstElementChild.innerHTML = "<i class='fas fa-times'></i> Co loi, vui long kiem tra lai";
                                al.firstElementChild.style.color = "red";
                                al.style.display = "flex";
                                setTimeout(() => {
                                    al.style.display = "none";
                                }, 2000);
                                return false;
                            }else if(this.responseText == "ok"){
                                al.firstElementChild.innerHTML = "<i class='fas fa-check-circle'></i> Dang ki thanh cong";
                                al.style.display = "flex";
                                errors.style.display = "none";
                                
                                setTimeout(function(){
                                    location.replace("forum.php");
                                },2000);
                                
                                return true;
                            }
                            return false;
                        }
                    }
                    xml.open("POST", "ajax/a-register.php");
                    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xml.send("res-btn="+resBtn+"&res-username="+val+"&res-password="+password+"&res-email="+email.value+"&res-password-confirm="+passwordConfirm);
                }else{
                    errors.innerHTML = this.responseText;
                    errors.style.display = "block";
                    return false;
                }
            }
        };
        xmlhttp.open("GET", "ajax/a-register.php?res-username="+val+"&res-email="+email.value);
        xmlhttp.send();
        
    }
    return false;
}

// login check
function logCheck(){
    var username = document.getElementById("log-username");
    var password = document.getElementById("log-password");
    var errors = document.getElementById("h-log-errors");
    if(username.value.search(/\W/i) == "" || username.value.search(/\W/i) >=0){
        errors.innerHTML = "Username k duoc chua ki tu dac biet";
        errors.style.display = "block";
        return false;
    }else{
        errors.style.display = "none";
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText == "ok"){
                    var al = document.getElementById("h-full-alert");
                    al.firstElementChild.innerHTML = "<i class='fas fa-check-circle'></i> Dang nhap thanh cong";
                    al.style.display = "flex";
                    errors.style.display = "none";
                    
                    setTimeout(function(){
                        location.replace("forum.php");
                    },2000);
                    
                    return true;
                }else{
                    errors.innerHTML = "Sai ten tai khoan hoac mat khau";
                    errors.style.display = "block";
                    return false;
                }
                
                
            }
        }
        xml.open("POST", "ajax/a-login.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("log-btn=&log-username="+username.value+"&log-password="+password.value);
        return false;
    }
    
}
function editUser(u_id){
    var email = document.getElementById("u-edit-email");
    var name = document.getElementById("u-edit-name");
    var birth = document.getElementById("u-edit-birth");
    var gender = document.getElementById("u-edit-gender");
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == "ok"){
                alert("Luu thong tin thanh cong");
            }else{
                alert(this.responseText);
                
            }
            
        }
    }
    xml.open("POST", "ajax/a-check-mail.php",false);
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
    xml.send("u_email="+email.value+'&u_id='+u_id+'&u_name='+name.value+'&u_gender='+gender.value+'&u_birth='+birth.value);
    return false;
    
}

function logout(){
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.responseText == "ok"){
                location.replace("forum.php");
            }else{
                alert(this.responseText);
            }
            
        }
    }
    xml.open("POST", "ajax/a-logout.php");
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
    xml.send("logout=true");
    return false;
}

function pagination(p,max, search, sql = ""){
    if(search == false){
        var paginationBox = document.getElementById("member-pagination");
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                paginationBox.innerHTML = this.responseText;
                var xmls = new XMLHttpRequest();
                xmls.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        var memCon = document.getElementById("member-container");
                        memCon.innerHTML = this.responseText;
                        
                    }
                }
                xmls.open("POST", "ajax/a-load-members.php");
                xmls.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
                xmls.send("page="+p+"&max="+max);
            }
        }
        xml.open("POST", "ajax/a-pagination.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("page="+p+"&max="+max);
    }else{
        var s = sql.toString();
        var paginationBox = document.getElementById("member-pagination");
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                paginationBox.innerHTML = this.responseText;
                var xmls = new XMLHttpRequest();
                xmls.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        var memCon = document.getElementById("member-container");
                        memCon.innerHTML = this.responseText;
                        
                    }
                }
                xmls.open("POST", "ajax/a-load-members.php");
                xmls.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
                xmls.send("page="+p+"&max="+max+"&sql="+s);
            }
        }
        xml.open("POST", "ajax/a-pagination.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("page="+p+"&max="+max+"&sql="+s);
    }
    return false;
}
function searchMember(it,p,max){
    if(it.value != ""){
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                // var memCon = document.getElementById("member-container");
                // memCon.innerHTML = this.responseText;
                pagination(p,max,true,this.responseText);
            }
        }
        xml.open("POST", "ajax/a-search-member.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("s="+it.value);
    }else{
        pagination(1,max,false);
    }
    
    
}

window.onscroll = function(){
    var currentScroll = window.scrollY
    if(currentScroll % 450 == 0){
        var user_id = document.getElementById("js-global-var");
        if(user_id.getAttribute("data-user-id") > 0){
            var xml = new XMLHttpRequest();
            xml.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    // alert(this.responseText);
                }
            }
            xml.open("POST", "ajax/a-update-status.php");
            xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
            xml.send("online=&u_id="+user_id.getAttribute("data-user-id"));
        }
        
    }

}

function adDeleteArticle(id){
    var conf = confirm('Ban co muon xoa cau hoi nay?');
    if(conf){
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                location.replace("forum.php");
            }
        }

        xml.open("POST","ajax/ad-article.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("f_delete=&a_id="+id);
    }
}
function adDeleteComment(id,f,g = 1){
    var conf = confirm('Ban co muon xoa binh luan nay?');
    if(conf){
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(f == false){
                    location.replace("forum.php");
                }else{
                    location.replace("forum-article.php?article_id="+g);

                }
                
            }
        }

        xml.open("POST","ajax/ad-article.php");
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
        xml.send("f_delComment=&a_id="+id);
    }
}
// function postQuickQuest(){
//     var xml = new XMLHttpRequest();
//     var txt = document.getElementById("addQuestionTxt");
//     xml.onreadystatechange = function(){
//         if(this.readyState == 4 && this.status == 200){
//             if(this.responseText == "ok"){
//                 alert("Dang cau hoi thanh cong");
//                 $(document).ready(function(){
//                     $("#quickQuestionModal").modal("hide");
//                     txt.value = "";
//                 });     
//             }else{
//                 alert("Co loi xay ra");
//             }
            
            
//         }
//     }
//     xml.open("POST", "ajax/a-quick-quest.php");
//     xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
//     xml.send("h-submit-btn=&h-txt-input="+txt.value);
//     return false;
// }

