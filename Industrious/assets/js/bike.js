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

