<?php
    // Connectar a la base de dades
    require_once('TControl.php');
    $tc = new TControl();

    // Obtindre el llistat de bicicletes agafades
    $bicicletes = $tc->obtenirBicicletesAgafades();

    // Mostrar el llistat de bicicletes agafades
    echo "<h1>Llistat de bicicletes agafades</h1>";
    echo "<table>";
    echo "<tr><th>Bicicleta</th><th>Ciutadà</th></tr>";
    foreach ($bicicletes as $bicicleta) {
        echo "<tr><td>".$bicicleta['bicicleta']."</td><td>".$bicicleta['ciutada']."</td></tr>";
    }
    echo "</table>";
?>
