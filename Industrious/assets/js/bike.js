var posx = 100;
var bike = document.querySelector("#bici");
var targetX = 0;
var direccion = 1; // 1 para la derecha, -1 para la izquierda

function init() {
    document.addEventListener("mousemove", posicion);
    moure();
}

function posicion(event) {
    targetX = event.clientX;
}

function moure() {
    var pos = bike.getBoundingClientRect();
    var posxbike = pos.left + pos.width / 2;
    var dist = targetX - posxbike;
    var vel = dist / 5000;

    // Cambia la dirección de la bicicleta
    if (vel > 0) {
        bike.style.transform = 'scaleX(-1)';
    } else {
        bike.style.transform = 'scaleX(1)';
    }

    posx += vel;
    bike.style.left = posx + 'px';
    requestAnimationFrame(moure);
}


init();



// init();
// function moure() {
//     var pos = bike.getBoundingClientRect();
//     var posxbike = pos.left + pos.width / 2;
//     bike.style.left = posx + 'px';
// }


// function rotate_Bike() {
//     const posx = event.clientX;
//     if (prev_posx > posx && !isFlipped) {
//       bici.style.transform = 'scale(-1, 1)';
//       isFlipped = true;
//     } else if (prev_posx <= posx && isFlipped) {
//       bici.style.transform = 'scale(1, 1)';
//       isFlipped = false;
//     }
//     prev_posx = posx;
//   }

