/**
* Fichier menu.js
* Description:Menu slider
* @author alice paré
* @version 2017-03-25
*/ 

function ouvrirMenu()
{
    document.getElementById("menuSlider").style.width="350px";
//    document.getElementById("page-top").style.width="100%";
}
function fermerMenu()
{
    document.getElementById("menuSlider").style.width="0";
   // document.getElementById("page-top").style.width="100%";
}



window.addEventListener('load',function(){
 
   var sltMenu = document.getElementById("menu");
    sltMenu.addEventListener("click",function(evt){
        console.log(sltMenu);
        ouvrirMenu();
        
    })
   
    var sltX = document.querySelector(".fermer");
    sltX.addEventListener("click",function(){
        console.log(sltX);
        fermerMenu();
    });
   
});