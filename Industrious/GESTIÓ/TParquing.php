<?php
//Classe de MODEL encarregada de la gestió de la taula PARQUING de la base de dades
include_once ("taccesbd.php");
class TParquing
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
        $res = $this->llistaParquings("SELECT id,adresa,maxBicis,numBicis FROM parquing WHERE numBicis > 0;");

        return $res;
    }

    public function llistaParquings($consulta_SQL)
    {
        $res = false;
        if ($this->abd->consulta_SQL($consulta_SQL))
        {   
            $fila = $this->abd->consulta_fila();
            $res =  "<select name='id'>";
            while ($fila != null)
            {
                $id = $this->abd->consulta_dada('id');
                $adresa = $this->abd->consulta_dada('adresa');
                $maxBicis = $this->abd->consulta_dada('maxBicis');
                $numBicis = $this->abd->consulta_dada('numBicis');
                            
                // $res = $res . "<option value='" . $id . "'>";
                $res = $res . "<option value='" . $id . "'> $id --> $adresa ( $numBicis disponibles de $maxBicis )  </option>";
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

}