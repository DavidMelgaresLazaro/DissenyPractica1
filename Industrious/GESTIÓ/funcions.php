<?php
header("Content-Type: text/html;charset=utf-8");
include_once("taccesbd.php");	

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


	/*************************************************************************/
	/* Funcions de consulta de dades */
	/*************************************************************************/

	function totalAterrats()
	{
		$res = 0;
        $sql = "select count(*) as quants from avio where aeroport is not null";
		connectar_BD();
        if (consulta_SQL($sql) )
        {
			
            if (consulta_fila())
            {
                $res = (consulta_dada('quants'));
            }
        }
		desconnectar_BD();
        return $res;
	}

	function totalVolant()
	{
		$sql = "select count(*) as quants from avio where aeroport is null";
		connectar_BD();
        if (consulta_SQL($sql) )
        {
            if (consulta_fila())
            {
                $res = (consulta_dada('quants'));
            }
        }
		desconnectar_BD();
        return $res;
	}

    function escriuCapsalera ($nom, $ciutat, $npistes)
    {
        $res = "<h1>Dades aeroport</h1><br>";
        $res = $res . "<h2>L'aeroport de $nom situat a $ciutat te $npistes pistes d'aterratge</h2><br><br>";
        return $res;
    }


	/*************************************************************************/
	/*Funcions principals*/
	/*************************************************************************/

	function enlairar ($id)
	{
        
		$res = false;
        $sql = "update avio set aeroport = null where idAvio = '$id'";
        connectar_BD();
        if (consulta_SQL($sql))
        {
            $res = true;      
        }
        desconnectar_BD();
    
        return $res;
	}

	function aterrar ($id, $aero)
	{
        $res = false;
        $sql = "update avio set aeroport = '$aero' where idAvio = '$id'";
		connectar_BD();
        if (consulta_SQL($sql))
        {
            $res = true;       
        }
		desconnectar_BD();
        return $res;
	}

	
    //FET
	function llistatVolant ()
	{
		$res = false;
        $sql = "select idAvio, tipus, npass from avio where aeroport is null";
		connectar_BD();
        if (consulta_SQL($sql))
        {
            $fila = consulta_fila();
            $res = $res . "<table border=1><tr bgcolor='lightblue'>
            <th>ID AVIÓ</th>
            <th>TIPUS</th>
            <th>NÚM. PASSATGERS</th>
            </tr> ";
            while ($fila != null)
            {
                $idAvio = consulta_dada('idAvio');
                $tipus = consulta_dada('tipus');
                $npass = consulta_dada('npass');
                
                $res = $res . "<tr>";
                $res = $res . "<td align='center'> $idAvio </td>";
                $res = $res . "<td align='right'> $tipus </td>";
                $res = $res . "<td align='left'> $npass </td></tr>";
                         
                $fila = consulta_fila();
            }
            $res = $res . "</table>";
            tancar_consulta();
        }
		desconnectar_BD();
        return $res;
	}

	//FET
	function llistatAvionsAeroport ($nomAero)
	{
        
		$res = false;
        $sql = "select nom, ciutat, nPistes from aeroport where nom = '$nomAero'";
		connectar_BD();
        if (consulta_SQL($sql))
        {
            $fila = consulta_fila();
            $nom = consulta_dada('nom');
            $ciutat = consulta_dada('ciutat');
            $npistes = consulta_dada('nPistes');
            $res = escriuCapsalera ($nom, $ciutat, $npistes);
            $sql = "select idAvio, tipus, npass from avio where aeroport = '$nomAero'";
            if (consulta_SQL($sql))
            {   
                $fila = consulta_fila();
                $res = $res . "<table border=1><tr bgcolor='lightblue'><th>ID Avió</th><th>Tipus</th><th>Núm. Passatgers</th></tr> ";
                while ($fila != null)
                {
                    $idAvio = consulta_dada('idAvio');
                    $tipus = consulta_dada('tipus');
                    $npass = consulta_dada('npass');
                    
                    $res = $res . "<tr>";
                    $res = $res . "<td align='center'> $idAvio </td>";
                    $res = $res . "<td align='center'> $tipus </td>";
                    $res = $res . "<td align='center'> $npass </td>";
                    $res = $res ."</tr>";
                             
                    $fila = consulta_fila();
                }
                $res = $res . "</table>";
                tancar_consulta();
            }
        }
		desconnectar_BD();
        return $res;
	}

/**************************************************************/
/* Llistats per a VISTA */
/*************************************************************/
/* LLISTES D'AVIONS
/*************************************************************/
	function llistaAvionsVolant()
    {
        $res = llistaAvions("select idAvio, tipus, npass from avio where aeroport is null");
        return $res;
    }

    function llistaAvionsAterrats()
    {
        $res = llistaAvions("select idAvio, tipus, npass from avio where aeroport is not null");
        return $res;
    }

    function llistaAvions($SQL)
    {
        $res = false;
		connectar_BD();
        if (consulta_SQL($SQL))
        {   
            $fila = consulta_fila();
            if ($fila == null)
            {
                $res = "<br><h2>Tots els avions estan volant!</h2><br>";
            }
            else
            {
                $res = "<select  name='idAvio'> ";
                while ($fila != null)
                {
                    $id = consulta_dada('idAvio');
                    $tipus = consulta_dada('tipus'); 
                    $npass = consulta_dada('npass');
                    
                    $res = $res . "<option value='" . $id . "'>";
                    $res = $res . "$id - $tipus - $npass passatgers </option>";
                    $fila = consulta_fila();
                }
                $res = $res . "</select>";
            }
            tancar_consulta();
        }
		desconnectar_BD();
        return $res;
    }

	/**************************************************************/
	/* LLISTES D'AEROPORTS
	/**************************************************************/

    function llistaAeroports()
    {
        $res = false;
        $SQL = "Select nom, npistes, ciutat from aeroport";
		connectar_BD();
        if (consulta_SQL($SQL))
        {   
            $fila = consulta_fila();
            if ($fila == null)
            {
                $res = "<br><h2>No hi ha cap aeroport al sistema!</h2><br>";
            }
            else
            {
                $res = "<select  name='nomAero'> ";
                while ($fila != null)
                {
                    $nom = consulta_dada('nom');
                    $npistes = consulta_dada('npistes'); 
                    $ciutat = consulta_dada('ciutat');
              
                    $res = $res . "<option value='" . $nom . "'>";
                    $res = $res . "$nom - $ciutat - $npistes </option>";
                    $fila = consulta_fila();
                }
                $res = $res . "</select><br>";
            }
            tancar_consulta();
        }
		desconnectar_BD();
        return $res;
    }
	