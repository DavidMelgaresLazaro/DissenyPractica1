<?php
    // Connectar a la base de dades
    require_once('TControl.php');
    $tc = new TControl();

    // Obtindre les dades enviades des de tornar.html
    $ciutadaId = $_POST['ciutada'];
    $parquingId = $_POST['parquing'];

    // Retornar la bicicleta
    $resultat = $tc->retornarBicicleta($ciutadaId, $parquingId);

    
    // Obtener las opciones de la tabla "ciutada"
    $opciones = $tc-> obtenerOpcionesCiutada($ciutadaId);
    

    // Comprovar si l'acció s'ha realitzat amb èxit o no
    if ($resultat) {
        echo "Bicicleta retornada amb èxit!";
    } else {
        echo "No s'ha pogut retornar la bicicleta. Si us plau, intenta-ho de nou.";
    }
?>