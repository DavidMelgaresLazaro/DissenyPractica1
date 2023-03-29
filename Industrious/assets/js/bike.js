// Obtenemos la imagen
var imagen = document.getElementById("pngwing.com.png");

// Definimos variables para la posición actual y la posición objetivo
var posicionActual = 0;
var posicionObjetivo = 0;

// Definimos una constante para el factor de suavizado
const factorSuavizado = 0.1;

// Obtenemos el ancho de la ventana
var anchoVentana = window.innerWidth;

// Función que se ejecuta cuando se mueve el ratón
document.onmousemove = function(e) {
    // Obtenemos la posición X del ratón
    posicionObjetivo = e.pageX;
};

// Función para animar la posición de la imagen
function animarImagen() {
    // Calculamos la nueva posición actual con suavizado
    posicionActual += (posicionObjetivo - posicionActual) * factorSuavizado;

    // Si la imagen llega al final de la página, la hacemos dar la vuelta
    if (posicionActual > anchoVentana) {
        posicionActual = 0;
    }

    // Actualizamos la posición X de la imagen
    imagen.style.left = posicionActual + "px";

    // Solicitamos el siguiente fotograma de animación
    requestAnimationFrame(animarImagen);
}

