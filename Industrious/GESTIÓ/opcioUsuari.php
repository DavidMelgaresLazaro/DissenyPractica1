<?php
header("Content-Type: text/html;charset=utf-8");
include_once ("Tcontrol.php");


function mostrarError ($missatge)
	{
		include_once("missatgeCap.html");
		echo "$missatge";
		include_once("missatgePeu.html");
	}


	function mostrarMissatge ($missatge)
	{
		include_once("missatgeCap.html");
		echo "$missatge";
		include_once("missatgePeu.html");
	}

	
if (isset($_POST["opcio"]))
{
	$opcio = $_POST["opcio"];
	switch ($opcio)
	{
		case "agafar":
			//comprobem que es pot agadar un avió
			$c = new Tcontrol();
			$numBicis = $c->totalAparcades();
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
			$numBicis = $c->totalAparcades();
			//si hi ha algún avió volant, es pot aterrar
			if ($numBicis > 0)
			{
				include_once("tornar.html");	
			}
			else
			{
				mostrarError("No l'has pogut deixar");

			}
			break;
		
		case "llistatAgafades":

			$c = new Tcontrol();
			$numBicis = $c->totalAgafades();
			print("numero:");
			print($numBicis);
			if ($numBicis > 0)
			{
				include_once("llistatAgafades.html");	
			}
			else
			{
				mostrarError("No s'ha pogut consultar");

			}
			break;

		case "Aterrats":
			include_once("llistatAterrats.html");
			break;
				
		default:
			echo "<br>ERROR: Opció no disponible<br>";

	}
}
?>

