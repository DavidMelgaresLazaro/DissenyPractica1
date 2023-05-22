<?php
header("Content-Type: text/html;charset=utf-8");
include_once("tcontrol.php");



// Aquí van les opcions de menú que necessiten demanar a l'usuari alguna dada addicional 
if (isset($_POST["opcio"]))
{
	$opcio = $_POST["opcio"];
	switch ($opcio)
	{
		case "agafar":
		{
			if (isset($_POST["id"]) )
			{
				$id = $_POST["id"];
				$c = new tcontrol();	
				$res = $c->agafar($id);
				if ($res)
				{
					mostrarMissatge("Bicicleta agafada correctament.");
				}
				else
				{
					mostrarError("Error al agafar la bicicleta");
				}
			}
			break;
		}

		case "tornar":
		{
			if (isset($_POST["id"]) && isset($_POST["parquing"]) )
			{
				$id = $_POST["id"];
				$parquing = $_POST["parquing"];
				$c = new tcontrol();
				$res = $c->tornar($id, $parquing);
				if ($res)
				{
					mostrarMissatge("Bicicleta deixada correctament.");
				}
				else
				{
					mostrarError("Error al deixar la bicicleta.");
				}
			}
			break;
		}

		case "llistatParquings":
		{
			if (isset($_POST["parquing"]))
			{
				$parquing = $_POST["parquing"];
				$c = new TControl();
				$res = $c->llistatBicisParquing($parquing);
				if ($res)
				{
					mostrarMissatge($res);
				}
				else
				{
					mostrarError("Error en generar la llista de bicicletas agafades a $parquing");
				}
			}
			break;	
		}

		default:
			mostrarError("Error: opció incorrecta");
	}
}