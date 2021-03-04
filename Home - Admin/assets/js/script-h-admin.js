

window.onload = function(){
    document.querySelector(".profile").addEventListener("click",function(){
        if(document.querySelector(".profile-box").style.left == '120px'){
            document.querySelector(".profile-box").style.left= '-310px';
        }
        else{
            document.querySelector(".profile-box").style.left = '120px';
        }
    })
}

