window.onload = function(){
    document.querySelector("#login").addEventListener("click",function(){
        if(document.querySelector(".login").style.opacity == '1'){
            document.querySelector(".login").style.opacity = '0';
        }
        else{
            document.querySelector(".login").style.opacity = '1';
        }
    })

    document.querySelector("#question").addEventListener("click",function(){
        if(document.querySelector(".question").style.opacity == '1'){
            document.querySelector(".question").style.opacity = '0';
        }
        else{
            document.querySelector(".question").style.opacity = '1';
        }
    })
}

