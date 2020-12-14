/* global $ */

var btn_prev = document.querySelector('.tabs .prev'),
    btn_next = document.querySelector('.tabs .next');
    
var images = document.querySelectorAll('.photo img');

var i = 0;

btn_prev.onclick = function(){
   images[i].className = "";
    i = i - 1;
    if( i < 0){
      i = images.length - 1;  
    }
    images[i].className = "shown";
};

btn_next.onclick = function(){
    images[i].className = "";
    i = i + 1; //i++
    if( i >= images.length){
      i = 0;  
    }
    images[i].className = "shown";
};

document.getElementById('like').addEventListener("click",
function(e){
  var id_foto = images[i].getAttribute("id_foto");
  alert("id foto - " + id_foto + ". Нужно отправиить в php и обработать");
}
);
