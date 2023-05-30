<?php
header("Content-Type: text/html;charset=utf-8");
include_once("Tcontrol.php");

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

// Aquí van les opcions de menú que necessiten demanar a l'usuari alguna dada addicional 
if (isset($_POST["opcio"]))
{
	$opcio = $_POST["opcio"];
	switch ($opcio)
	{
		case "Agafar":
		{
			if (isset($_POST["id"]) && isset($_POST["DNI"]))
			{
				$id = $_POST["id"];
				$DNI = $_POST["DNI"];
				$c = new Tcontrol();
				$res = $c->agafar($id,$DNI);
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

		case "Tornar":
		{
			
			if (isset($_POST["id"]) && isset($_POST["DNI"]) )
			{
				
				$id = $_POST["id"];
				$DNI = $_POST["DNI"];
				$c = new Tcontrol();
				$res = $c->tornar($id, $DNI);
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

		case "llistatAgafades":
			{
			
				$parquing = $_POST["parquing"];
				$c = new Tcontrol();
				$res = $c->llistatOcupades($parquing);
				if ($res)
				{
					mostrarMissatge($res);
				}
				else
				{
					mostrarError("Error en generar la llista de bicicletas agafades");
				}
				
				break;	
			}

		case "llistatAgafades":
			{
			
				$parquing = $_POST["parquing"];
				$c = new Tcontrol();
				$res = $c->llistatOcupades($parquing);
				if ($res)
				{
					mostrarMissatge($res);
				}
				else
				{
					mostrarError("Error en generar la llista de bicicletas agafades");
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