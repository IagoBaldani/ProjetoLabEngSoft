window.onload = function(){
    document.querySelector(".i-senha").addEventListener("click",function(){
        if(document.querySelector(".info-senha").style.opacity == '1'){
            document.querySelector(".info-senha").style.opacity= '0';
        }
        else{
            document.querySelector(".info-senha").style.opacity= '1';
        }
    })
}
