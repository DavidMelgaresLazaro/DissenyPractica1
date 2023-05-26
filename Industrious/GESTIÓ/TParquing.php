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
    public function ParquingsAmbDeixarBicis()
    {
        $res = 0;
        $res = $this->llistaParquings("SELECT id,adresa,maxBicis,numBicis FROM parquing WHERE numBicis < maxBicis;");

        return $res;
    }

    public function llistaParquings($query)
{
    $res = false;
    if ($this->abd->consulta_SQL($query))
    {
        $res = "<select name='id'>";
        while ($fila = $this->abd->consulta_fila())
        {
            $id = $fila['id'];
            $adresa = $fila['adresa'];
            $maxBicis = $fila['maxBicis'];
            $numBicis = $fila['numBicis'];
                        
            $res .= "<option value='" . $id . "'>";
            $res .= "$id --> $adresa ($numBicis disponibles de $maxBicis)</option>";
        }
        $res .= "</select><br>";
        $this->abd->tancar_consulta();
    }
    else
    {
        $res = "<select name='id'></select><br>";
    }
    return $res; 
}




    

}
