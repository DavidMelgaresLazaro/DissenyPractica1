<?php
//Classe de MODEL encarregada de la gestió de la taula AVIO de la base de dades
include_once ("taccesbd.php");
class TBicicleta
{
    private $id;
    private $kilometres;
    private $DNICiutada;
    private $idParquing;
    private $abd;
    function __construct($v_id, $v_kilometres, $v_DNICiutada, $v_idParquing,$host,$username,$password,$database,$port)
    {
        $this->id = $v_id;
        $this->kilometres = $v_kilometres;
        $this->DNICiutada = $v_DNICiutada;
        $this->idParquing = $v_idParquing;
        $var_abd = new taccesbd($host,$username,$password,$database,$port);
        $this->abd = $var_abd;
        $this->abd->connectar_BD();

    }

    function __destruct()
    {
        if (isset($this->abd))
        {
        unset($this->abd);
        }
    }

    public function totalAparcades()
	{
		$res = 0;
        $sql = "select count(*) as quants from bicicleta where idParquing is not null";
	
        if ($this->abd->consulta_SQL($sql) )
        {
			
            if ($this->abd->consulta_fila())
            {
                $res = ($this->abd->consulta_dada('quants'));
            }
        }
        return $res;
	}

	public function totalOcupades()
	{
        $res = 0;
		$sql = "select count(*) as quants from bicicleta where parquing is null";
		if ($this->abd->consulta_SQL($sql) )
        {
            if ($this->abd->consulta_fila())
            {
                $res = ($this->abd->consulta_dada('quants'));
            }
        }
        return $res;
	}

    public function llistaBicicletesOcupades()
    {
        $res = $this->llistaAvions("select id, idParquing, DNICiutada from bicicleta where parquing is null");
        return $res;
    }

    public function llistaBicicletesAparcades()
    {
        $res = $this->llistaAvions("select id, idParquing, DNICiutada from bicicleta where parquing is not null");
        return $res;
    }

    public function llistaBicicletes($SQL)
    {
        $res = false;

        if ($this->abd->consulta_SQL($SQL))
        {   
            $fila = $this->abd->consulta_fila();
            if ($fila == null)
            {
                $res = "<br><h2>Totes les bicicletes estan ocupades!</h2><br>";
            }
            else
            {
                $res = "<select  name='id'> ";
                while ($fila != null)
                {
                    $id = $this->abd->consulta_dada('id');
                    $tipus = $this->abd->consulta_dada('idParquing'); 
                    $npass = $this->abd->consulta_dada('DNICiutada');
                    
                    $res = $res . "<option value='" . $id . "'>";
                    $res = $res . "$id - $tipus - $npass passatgers </option>";
                    $fila = $this->abd->consulta_fila();
                }
                $res = $res . "</select>";
            }
            $this->abd->tancar_consulta();
        }
        return $res;
    }



    public function ocupar()
	{

		$res = false;
        $sql = "update bicicleta set idParquing = NULL , DNICiutada = '$this->DNICiutada' WHERE id = '$this->id';";
        if ($this->abd->consulta_SQL($sql))
        {
            $res = true;
        }
        $this->baixarNumParking();
    
        return $res;
	}

    public function baixarNumParking()
    {
        $res = false;
        $sql = "UPDATE parquing SET numBicis = numBicis - 1 WHERE id = (SELECT idParquing FROM bicicleta WHERE id = '$this->id');";
        if ($this->abd->consulta_SQL($sql))
        {
            $res = true;
        }

    }

	function deixar ()
	{
        $res = false;
        $sql = "update bicicleta set parquing = '$this->parquing' where id = '$this->id'";
        if ($this->abd->consulta_SQL($sql))
        {
            $res = true;       
        }
        return $res;
	}

    public function llistatOcupades()
    {
        $res = false;
        if ($this->abd->consulta_SQL("select * from bicicleta where parquing is null"))
        {   
            $fila = $this->abd->consulta_fila();
            $res =  "<table border=1><tr bgcolor='lightgray'>
                        <th>id</th><th>adresa</th><th>DNICiutada</th>
                    </tr> ";
            while ($fila != null)
            {
                $id = $this->abd->consulta_dada('id');
                $adresa= $this->abd->consulta_dada('adresa');
                $DNICiutada = $this->abd->consulta_dada('DNICiutada');
   
                $res = $res . "<tr>";
                $res = $res . "<td>$id</td>";
                $res = $res . "<td>$adresa</td>";
                $res = $res . "<td align='right'>$DNICiutada</td>";
                $res = $res . "</tr>";
                $fila = $this->abd->consulta_fila();
            }
            $res = $res . "</table>";
            $this->abd->tancar_consulta();
        }
        else
        {
            $res = "<h2>No s'ha pogut realitzar el llistat de bicicletes ocupades.</h2>";
        }
        return $res; 
    }


    private function escriuCapsalera ($id, $adresa, $maxBicis, $numBicis)
    {
        $res = "<h1>Dades parquing</h1>";
        $res = $res . "<h2>El parquing de ID:  $id situat a $adresa te un maxim de $maxBicis i hara mateix te un numero $numBicis bicicletes</h2><br>";
        return $res;
    }


    public function llistatBicletesParquing ()
	{
        
		$res = false;
        $sql = "select id, adresa, maxBicis, numBicis from parquing where id = '$this->parquing'";

        if ($this->abd->consulta_SQL($sql))
        {
            $fila = $this->abd->consulta_fila();
            $id = $this->abd->consulta_dada('id');
            $adresa = $this->abd->consulta_dada('adresa');
            $maxBicis = $this->abd->consulta_dada('maxBicis');
            $numBicis = $this->abd->consulta_dada('numBicis');
            $res = $this->escriuCapsalera ($id, $adresa, $maxBicis);
            $sql = "select id, adresa, DNICiutada from bicicleta where parquing = '$this->parquing'";
            if ($this->abd->consulta_SQL($sql))
            {   
                $fila = $this->abd->consulta_fila();
                $res = $res . "<table border=1><tr bgcolor='lightblue'><th>ID Bicicleta</th><th>adresa</th><th>DNI Ciutada</th></tr> ";
                while ($fila != null)
                {
                    $id = $this->abd->consulta_dada('id');
                    $adresa = $this->abd->consulta_dada('adresa');
                    $DNICiutada = $this->abd->consulta_dada('DNICiutada');
                    
                    $res = $res . "<tr>";
                    $res = $res . "<td align='center'> $id </td>";
                    $res = $res . "<td align='center'> $adresa </td>";
                    $res = $res . "<td align='center'> $DNICiutada </td>";
                    $res = $res ."</tr>";
                             
                    $fila = $this->abd->consulta_fila();
                }
                $res = $res . "</table><br>";
                $this->abd->tancar_consulta();
            }
        }
        return $res;
	}
///////////////////////////////////////////////////





}