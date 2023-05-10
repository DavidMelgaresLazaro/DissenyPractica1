<?php
header("Content-Type: text/html;charset=utf-8");
include_once ("tcontrol.php");

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

//////////////////////////// CODI /////////////////////

if (isset($_POST["opcio"]))
{
	$opcio = $_POST["opcio"];
	switch ($opcio)
	{
		case "Agafar Bi":
			//comprobem que es pot enlairar un avió
			$c = new tcontrol();
			$numAterrats = $c->totalAterrats();

			//Si encara hi ha avions aterrats
			if ($numAterrats > 0)
			{
				include_once("enlairar.html");
			}
			else
			{
				mostrarError("Tots els avions estan volant");
			}
			
			break;
		
		case "Aterrar":
			// comprovem que es pot aterrar algún avió
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