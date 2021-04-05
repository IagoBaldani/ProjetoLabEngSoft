
window.onload = function(){
    document.querySelector("#type").addEventListener("change", function(){
        if(document.getElementById("1t").selected === true){
            document.getElementById("curso").style.display="block";
        }
        else{
            document.getElementById("curso").style.display="none";
        }
    });  
}
