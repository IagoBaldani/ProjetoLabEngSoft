window.onload = function(){
    document.querySelector(".info").addEventListener("click",function(){
        if(document.querySelector(".info-box").style.opacity == '1'){
            document.querySelector(".info-box").style.opacity= '0';
        }
        else{
            document.querySelector(".info-box").style.opacity= '1';
        }
    })

    document.querySelector(".info2").addEventListener("click",function(){
        if(document.querySelector(".info-box2").style.opacity == '1'){
            document.querySelector(".info-box2").style.opacity= '0';
        }
        else{
            document.querySelector(".info-box2").style.opacity= '1';
        }
    })
}
