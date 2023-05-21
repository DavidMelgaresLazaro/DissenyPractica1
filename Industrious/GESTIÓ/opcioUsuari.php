<?php
header("Content-Type: text/html;charset=utf-8");
include_once ("Tcontrol.php");



if (isset($_POST["opcio"]))
{
	$opcio = $_POST["opcio"];
	switch ($opcio)
	{
		case "agafar":
			//comprobem que es pot agadar un avió
			$c = new Tcontrol();
			$numBicis = $c->llistatAgafades();

			//Si encara hi ha avions aterrats
			if ($numBicis > 0)
			{
				include_once("agafar.html");
			}
			else
			{
				mostrarError("Totess les bicicletes estan agafades");
			}
			
			break;
		
		case "deixar":
			// comprovem que es pot agafar alguna bicicleta
			$c = new tcontrol();
			$numVolant = $c->totalVolant();
			//si hi ha algún avió volant, es pot aterrar
			if ($numVolant > 0)
			{
				include_once("aterrar.html");	
			}
			else
			{
				mostrarError("No hi ha cap avió volant");

			}
			break;
		
		case "Volant":
			include_once("llistatVolant.html");
			break;

		case "Aterrats":
			include_once("llistatAterrats.html");
			break;
				
		default:
			echo "<br>ERROR: Opció no disponible<br>";

	}
}
?>

