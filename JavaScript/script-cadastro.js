function formatar(src, mask){
    var i = src.value.length;
    var saida = mask.substring(0,1);
    var texto = mask.substring(i)

    console.log("Entrou");
    
    if (texto.substring(0,1) != saida){
        src.value += texto.substring(0,1);
    }
}


window.onload = function(){
    document.querySelector(".i-senha").addEventListener("click",function(){
        if(document.querySelector(".info-senha").style.opacity == '1'){
            document.querySelector(".info-senha").style.opacity= '0';
        }
        else{
            document.querySelector(".info-senha").style.opacity= '1';
        }
    })

    document.querySelector("#type").addEventListener("change", function(){
        if(document.getElementById("1t").selected === true){
            document.getElementById("curso").style.display="block";
            document.getElementById("ra").style.display="block";
        }
        else{
            document.getElementById("curso").style.display="none";
            document.getElementById("ra").style.display="none";
        }
    });
}
