<?php
header("Content-Type: text/html;charset=utf-8");

//Classe de CONTROLADOR
include_once ("TBicicleta.php");
include_once ("TCiutada.php");
include_once ("TParquing.php");





class TControl
{
	private $servidor;
	private $usuari;
	private $paraula_pas;
	private $nom_bd;
	function __construct()
	{
		$this->servidor = "localhost";
		$this->usuari = "root";
		$this->paraula_pas = "usbw";
		$this->nom_bd = "bicing";
	}

	////////////// Mètodes per a muntar llistes desplegables als fitxers HTML i comprovacions de VISTA
	
	public function llistaParquings()
	{
		$res = 0;
		$ae = new TParquing("","",0,$this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);	
		$res = $ae->llistaParquings();
		return $res;
	}
	
	
	////////// Mètodes per a realitzar les opcions de menú
	
	public function agafar($id)
	{
		$res = 0;
		$av = new TBicicleta ($id,"","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $av->agafar();
		return $res;
	}

	public function tornar($id, $Parquing)
	{
		$res = 0;
		$av = new TBicicleta($id,"","",$Parquing, $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $av->tornar();
		return $res;
	}

	public function llistatAgafades ()
	{
		$res = 0;
		$ae = new TBicicleta ("","","","", $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $ae->llistatAgafades();
		return $res;
	}

	public function llistatBicisParquing ($parquing)
	{
		$res = 0;
		$ae = new TBicicleta ("","","",$parquing, $this->servidor, $this->usuari, $this->paraula_pas, $this->nom_bd);
		$res = $ae->llistatBicisParquing();
		return $res;
	}

/////////////////////////////////////////

}