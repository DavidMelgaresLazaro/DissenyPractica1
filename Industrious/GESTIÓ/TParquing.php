<?php
//Classe de MODEL encarregada de la gestió de la taula PARQUING de la base de dades
include_once ("taccesbd.php");
class Tparquing
{
    private $id;
    private $adresa;
    private $maxBicis;
    private $numBicis;
    private $abd;
    function __construct($v_id, $v_adresa, $v_maxBicis,$v_numBicis, $host,$username,$password,$database,$port)
    {
        $this->id = $v_id;
        $this->adresa = $v_adresa;
        $this->maxBicis = $v_maxBicis;
        $this->numBicis = $v_numBicis;
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

    public function ParquingsAmbBicis()
    {
        $res = 0;
        $res = $this->llistaParquings("SELECT adresa,id,numBicis,maxBicis FROM parquing WHERE numBicis > 0;")
    }

    public function llistaParquings()
    {
        $res = false;
        if ($this->abd->consulta_SQL("select id, adresa from parquing order by id"))
        {   
            $fila = $this->abd->consulta_fila();
            $res =  "<select name='parquing'>";
            while ($fila != null)
            {
                $id = $this->abd->consulta_dada('id');
                $adresa = $this->abd->consulta_dada('adresa');
                            
                $res = $res . "<option value='" . $fila["id"] . "'>".$fila["id"]." - " . $fila["adresa"]. "</option>";
               
                $fila = $this->abd->consulta_fila();
            }
            $res = $res . "</select><br>";
            $this->abd->tancar_consulta();
        }
        else
        {
            $res = "<select name='parquing'></select><br>";
        }
        return $res; 
    }


///////////////////////////////////////////////////

}