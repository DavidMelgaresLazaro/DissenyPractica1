<?php
    // Connectar a la base de dades
    require_once('tcontrol.php');
    $tc = new TControl();

    // Obtindre el llistat de párquings amb bicicletes disponibles
    $parquings = $tc->obtenirParquingsAmbBicicletes();

    // Mostrar el llistat de párquings amb bicicletes disponibles
    echo "<h1>Llistat de párquings amb bicicletes disponibles</h1>";
    echo "<ul>";
    foreach ($parquings as $parquing) {
        echo "<li>".$parquing['parquing']."</li>";
    }
    echo "</ul>";
?>
