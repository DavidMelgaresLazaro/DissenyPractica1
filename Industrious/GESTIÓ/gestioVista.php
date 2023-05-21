<?php
// Classe TControl
class TControl {
    // Mètode per mostrar missatges o errors
    public function mostrarMissatge($missatge) {
        // Codi per mostrar el missatge
        echo $missatge;
    }

    // Mètode per gestionar l'opció "agafar"
    public function agafar() {
        if (isset($_POST["idBicicleta"]) )
			{
				$id = $_POST["idBicicleta"];
				$c = new tcontrol();	
				$res = $c->enlairar($id);
				if ($res)
				{
					mostrarMissatge("Bicicleta agafada!");
				}
				else
				{
					mostrarError("Error en agafarBicicleta");
				}
			}
			break;
    }

    // Mètode per gestionar l'opció "tornar"
    public function tornar() {
        if (isset($_POST["idBicicleta"]) && isset($_POST["Parquing"]) )
			{
				$id = $_POST["idBicicleta"];
				$parquing = $_POST["Parquing"];
				$c = new TControl();
				$res = $c->aterrar($id, $parquing);
				if ($res)
				{
					mostrarMissatge("Bicicleta retornada correctement");
				}
				else
				{
					mostrarError("Error en retornar");
				}
			}
			break;
    }

    // Mètode per generar el llistat de bicicletes agafades
    public function generarLlistatAgafades() {
        if (isset($_POST["Agafades"]))
			{
				$Agafades = $_POST["Agafades"];
				$c = new TControl();
				$res = $c->llistatAvionsAeroport($Agafades);
				if ($res)
				{
					mostrarMissatge($res);
				}
				else
				{
					mostrarError("Error en generar la llista d'avions aterrats a $Agafades");
				}
			}
			break;	
    }

    // Mètode per generar el llistat de pàrquings disponibles
    public function generarLlistatParquings() {
        if (isset($_POST["Disponibles"]))
			{
				$Disponibles = $_POST["Disponibles"];
				$c = new TControl();
				$res = $c->llistatAvionsAeroport($Disponibles);
				if ($res)
				{
					mostrarMissatge($res);
				}
				else
				{
					mostrarError("Error en generar la llista d'avions aterrats a $Disponibles");
				}
			}
			break;	
    }
}

// Obté l'opció triada per l'usuari
$opcioTriada = $_GET['opcio'];

// Crea una instància de la classe TControl
$control = new TControl();

// Tracta l'opció triada
switch ($opcioTriada) {
    case 'agafar':
        $control->agafar();
        break;
    case 'tornar':
        $control->tornar();
        break;
    case 'llistatAgafades':
        $control->generarLlistatAgafades();
        break;
    case 'llistatParquing':
        $control->generarLlistatParquings();
        break;
    default:
        $control->mostrarMissatge("Opció no vàlida");
        break;
}
?>
