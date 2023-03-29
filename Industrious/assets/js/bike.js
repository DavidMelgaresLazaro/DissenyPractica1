var posx = 100;

var bike = document.querySelector("#bici");


function posicion(event) {
    posx=event.clientX;
	bike.style.left =posx + 'px';
    bike.style.transform = 'rotate(' + graus + 'deg)';
    requestAnimationFrame(moure);
}



function moure() {
    var pos = 0;
    
    var pos = bike.getBoundingClientRect();

    var posxbike= pos.left + pos.width / 2;

	bike.style.left= posx + 'px';
    bike.style.transform = 'rotate(' + graus + 'deg)';
	requestAnimationFrame(moure);
}



function rotate_Bike(event) {
    const posx = event.clientX;
    if (prev_posx > posx && !isFlipped) {
      bici.style.transform = 'scale(-1, 1)';
      isFlipped = true;
    } else if (prev_posx <= posx && isFlipped) {
      bici.style.transform = 'scale(1, 1)';
      isFlipped = false;
    }
    prev_posx = posx;
  }

