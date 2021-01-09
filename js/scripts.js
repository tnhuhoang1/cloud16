function initialElement(){
    var eSearchBox = document.getElementById("h-slide-search");
    eSearchBox.style.display = "block";
    var searchWidth = eSearchBox.offsetWidth;
    eSearchBox.style.right = "-"+searchWidth+"px";
}

// scroll nav bar
var prevScroll = window.scrollY;
window.onscroll = function(){
    var navHeight = document.getElementById("h-main-navbar").offsetHeight;
    var pageHeight = innerHeight;
    var currentScroll = window.scrollY;
    if(currentScroll > pageHeight){
        document.getElementById("h-main-navbar").style.position = "fixed";
        if(prevScroll < currentScroll){
            document.getElementById("h-main-navbar").style.top = "-"+navHeight+"px";
            document.getElementById("h-main-navbar").style.transition = "0s";
        }else{
            document.getElementById("h-main-navbar").style.top = "0px";
            document.getElementById("h-main-navbar").style.transition = "0.5s";
        }
        
    
    }else{
        document.getElementById("h-main-navbar").style.position = "static";
    }
    prevScroll = currentScroll;
}

//// scroll navbar

// toggle side slide search
function toggleSearch(){
    initialElement();
    var eSearchBox = document.getElementById("h-slide-search");
    var searchWidth = eSearchBox.offsetWidth;
    eSearchBox.style.right = "0px";
    eSearchBox.style.transition = "right 0.3s";
}

function closeSearchBox(){
    var eSearchBox = document.getElementById("h-slide-search");
    eSearchBox.style.right = "-100%";
    eSearchBox.style.transition = "right 0.5s";
    //disappearSearchBox();
}

// function disappearSearchBox(){
//     var eSearchBox = document.getElementById("h-slide-search");
//     eSearchBox.style.display = "none";
// }
// // toggle side slide search

// forum slide

$(document).ready(function(){
    $('.h-forum-slide').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    nextArrow : $(".h-slide-next"),
    prevArrow: $(".h-slide-prev"),
    responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }]
    });
    $(".h-ps-sub-nav .h-li").hover(function(){
      $(this).find("i").show();
    },function(){
      $(this).find("i").hide();
    });
  
});
// // forum slides

function shotcutPost(cID, sID, aID){
  let title = document.getElementById("hSidebarModalTitle");
  let content = document.getElementById("hSidebarModalContent");
  let xml = new XMLHttpRequest();
  xml.responseType = "json";
  xml.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        let data = this.response;
        title.innerHTML = data[0]['title'];
        if(data[1]['img'] != ""){
          let img = data[1]['img'];
          img = `<img src="admin/${img}" class="img-fluid" alt="" style="width: 100%;"></img>`;
          content.innerHTML = img + '<p>'+data[2]['content']+'</p>';
          
        }else{
          content.innerHTML = '<p>'+data[2]['content']+'</p>';
        }
        
      }
  }
  xml.open("POST", "ajax/cse-ajax.php");
  xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
  xml.send("loadShotcutPost=&cate_id="+cID+"&sub_cate_id="+sID+"&ar_id="+aID);

}

function slideSearch(input = ""){
  let searchTxt = document.getElementById("searchInput");
  let found = document.getElementById("searchFound");
  let recent = document.getElementById("searchRecent");
  let xml = new XMLHttpRequest();
  xml.responseType = "json";
  if(input != ""){
    xml.onreadystatechange = function(){
      if(this.readyState == 4 && this.status == 200){
        let data = this.response;
        let foundString = '<p class="h-s-r-found-text">Ket Qua</p>';
        for(let i = 0 ; i < data[0].length; i++){
          foundString+= data[0][i];
        }
        let recentString = '<p class="h-s-r-title">Gan day</p>';
        for(let i = 0 ; i < data[1].length; i++){
          recentString+= '<p class="h-s-r-text"><a href="#" class="h-a" onclick="slideSearch(\''+data[1][i]+'\')">- '+data[1][i]+'</a></p>';
        }
        found.innerHTML = foundString;
        recent.innerHTML = recentString;
        
      }
    }
    xml.open("POST", "ajax/cse-ajax.php");
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
    xml.send("cseSearch=&key="+input);
  }else if(searchTxt.value != ""){ 
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
          let data = this.response;
          let foundString = '<p class="h-s-r-found-text">Ket Qua</p>';
          for(let i = 0 ; i < data[0].length; i++){
            foundString+= data[0][i];
          }
          let recentString = '<p class="h-s-r-title">Gan day</p>';
          for(let i = 0 ; i < data[1].length; i++){
            recentString+= '<p class="h-s-r-text"><a href="#" class="h-a" onclick="slideSearch(\''+data[1][i]+'\')">- '+data[1][i]+'</a></p>';
          }
          found.innerHTML = foundString;
          recent.innerHTML = recentString;
          
        }
    }
    xml.open("POST", "ajax/cse-ajax.php");
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded" );
    xml.send("cseSearch=&key="+searchTxt.value);
  }
}
