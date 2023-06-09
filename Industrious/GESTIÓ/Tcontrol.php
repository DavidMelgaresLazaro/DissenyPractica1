<?php
header("Content-Type: text/html;charset=utf-8");

//Classe de CONTROLADOR
include_once ("Tbicicleta.php");
include_once ("TCiutada.php");
include_once ("TParquing.php");




class Tcontrol
{

	private $host;
	private $username;
	private $password;
	private $port;
	private $database;	

	function __construct()
	{
		$this->host = "localhost";
		$this->username = "root";
		$this->port = "8888";
		$this->password = "root";
		$this->database = "bicing"; 
	}

    

	////////////// Mètodes per a muntar llistes desplegables als fitxers HTML i comprovacions de VISTA
	



	public function totalAparcades()
	{
		$res = 0;
		$av = new Tbicicleta ("","","","", $this->host,$this->username,$this->password,$this->database,$this->port);
		$res = $av->totalAparcades();
        return $res;
	}

	public function llistaParquings()
	{
		$res = 0;
		$ae = new TParquing("","","","",$this->host,$this->username,$this->password,$this->database,$this->port);	
		$res = $ae->llistaParquings();
		return $res;
	}
	
	
	////////// Mètodes per a realitzar les opcions de menú
	
	public function agafar($id,$DNI)
	{	
		$res = 0;
		$av = new Tbicicleta ($id,"",$DNI,"", $this->host,$this->username,$this->password,$this->database,$this->port);
		$res = $av->ocupar();
		return $res;
	}

	public function tornar($id, $Parquing)
	{
		$res = 0;
		$av = new Tbicicleta($id,"","",$Parquing,$this->host,$this->username,$this->password,$this->database,$this->port);
		$res = $av->deixar();
		return $res;
	}

	public function llistatAgafades ()
	{
		$res = 0;
		$ae = new TBicicleta ("","","","",$this->host,$this->username,$this->password,$this->database,$this->port);
		$res = $ae->llistatOcupades();
		return $res;
	}

	public function totalAgafades ()
	{
		$res = 0;
		$ae = new TBicicleta ("","","","",$this->host,$this->username,$this->password,$this->database,$this->port);
		$res = $ae->llistatOcupades();
		return $res;
	}

	public function totalAgafades ()
	{
		$res = 0;
		$ae = new Tbicicleta ("","","","",$this->host,$this->username,$this->password,$this->database,$this->port);
		$res = $ae->totalOcupades();
		return $res;
	}

	public function llistatParquingAmbBicis()
	{
		$res = 0;
		$ae = new TParquing ("","","","",$this->host,$this->username,$this->password,$this->database,$this->port);
		$res = $ae->ParquingsAmbBicis();
		return $res;
	}
	public function llistatParquingAmbDeixarBicis()
	{
		$res = 0;
		$ae = new TParquing ("","","","",$this->host,$this->username,$this->password,$this->database,$this->port);
		$res = $ae->ParquingsAmbDeixarBicis();
		return $res;
	}

	public function llistatBicisParquing ($parquing)
	{
		$res = 0;
		$ae = new Tbicicleta ("","","",$this->host,$this->username,$this->password,$this->database,$this->port);
		$res = $ae->llistatBicisParquing();
		return $res;
	}
	public function llistatUsuarisFree()
	{
		$res = 0;
		$ae = new TCiutada ($this->host,$this->username,$this->password,$this->database,$this->port);
		$res = $ae->llistatUsuarisFree();
		return $res;

	}
	public function llistatUsuarisNotFree()
	{
		$res = 0;
		$ae = new TCiutada ($this->host,$this->username,$this->password,$this->database,$this->port);
		$res = $ae->llistatUsuarisNotFree();
		return $res;


	}

	

}