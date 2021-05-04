
window.onload = function(){
    document.querySelector(".btnImg").addEventListener("click", function(){
        if(document.querySelector(".submit-box").style.display === "flex"){
            document.querySelector(".submit-box").style.display = "none";
        }
        else{
            document.querySelector(".submit-box").style.display = "flex";
        }
    });
}
