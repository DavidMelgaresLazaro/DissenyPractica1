<?php
    // Connectar a la base de dades
    require_once('TControl.php');
    $tc = new TControl();

    // Comprovar l'opció triada per l'usuari
    $opcio = $_POST['opcio'];
    switch ($opcio) {
        case 'agafar':
            $ciutadans = $tc->obtenirCiutadansSenseBicicleta();
            $parquings = $tc->obtenirParquingsAmbBicicletesDisponibles();
            require_once('agafar.html');
            break;
        case 'tornar':
            $ciutadans = $tc->obtenirCiutadansAmbBicicleta();
            $parquings = $tc->obtenirParquingsNoPlens();
            require_once('tornar.html');
            break;
        case 'llistatAgafades':
            $bicicletes = $tc->obtenirBicicletesAgafades();
            require_once('llistatAgafades.html');
            break;
        case 'llistatParquing':
            $parquings = $tc->obtenirParquingsAmbBicicletes();
            require_once('llistatParquing.html');
            break;
        default:
            echo "<br>ERROR: Opció no disponible<br>";
            break;
    }
?>
