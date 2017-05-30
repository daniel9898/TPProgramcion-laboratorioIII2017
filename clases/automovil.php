<?php
require_once "AccesoDatos.php";

class Automovil 
{
	public $id_automovil;
	public $patente;
 	public $color;
  	public $marca;

  	public function GetId()
	{
		return $this->id_automovil;
	}
	public function GetPatente()
	{
		return $this->patente;
	}
	public function GetColor()
	{
		return $this->color;
	}
	public function GetMarca()
	{
		return $this->marca;
	}
	public function SetId($valor)
	{
		$this->id_automovil = $valor;
	}
	public function SetPatente($valor)
	{
		$this->patente = $valor;
	}
	public function SetColor($valor)
	{
		$this->color = $valor;
	}
	public function SetMarca($valor)
	{
		$this->marca = $valor;
	}
	
	function __construct($id=NULL)
	{
		if($id != NULL){
			$obj = Automovil::TraerUnAutomovil($id);
			
			$this->patente = $obj->patente;
			$this->color = $obj->color;
			$this->marca = $obj->$marca;
			$this->id_automovil = $obj->id;
		}
	}

	public function ToString()
	{
	  	return $this->patente."-".$this->color."-".$this->marca;
	}
}

?>