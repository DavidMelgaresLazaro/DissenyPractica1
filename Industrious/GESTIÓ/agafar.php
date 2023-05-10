<?php
    // Connectar a la base de dades
    require_once('TControl.php');
    $tc = new TControl();

    // Obtindre les dades enviades des de agafar.html
    $ciutadaId = $_POST['ciutada'];
    $parquingId = $_POST['parquing'];

    // Agafar la bicicleta
    $resultat = $tc->agafarBicicleta($ciutadaId, $parquingId);

    // Comprovar si l'acció s'ha realitzat amb èxit o no
    if ($resultat) {
        echo "Bicicleta agafada amb èxit!";
    } else {
        echo "No s'ha pogut agafar la bicicleta. Si us plau, intenta-ho de nou.";
    }
?>