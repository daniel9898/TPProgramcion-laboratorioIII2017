<?php
require_once "AccesoDatos.php";

class Automovil 
{
	//public $id;
	public $patente;
 	public $color;
  	public $marca;

  	/*public function GetId()
	{
		return $this->id;
	}*/
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
	/*public function SetId($valor)
	{
		$this->id = $valor;
	}*/
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
	
	function __construct($patente=NULL)
	{
		if($patente != NULL){
			$obj = Automovil::TraerUnAutomovil($patente);
			
			$this->patente = $obj->patente;
			$this->color = $obj->color;
			$this->marca = $obj->$marca;
		}
	}

	public function ToString()
	{
	  	return $this->patente."-".$this->color."-".$this->marca;
	}

	/*public static function TraerUnAutomovil($patente) 
	{	
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("select * from automovil where patente =:patente");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL TraerUnaPersona(:id)");
		$consulta->bindValue(':patente', $patente, PDO::PARAM_INT);
		$consulta->execute();
		$autoBuscado = $consulta->fetchObject('Automovil');
		return $autoBuscado;	
					
	}

	public static function InsertarAutomovil($automovil)
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into automovil (patente,color,marca)values(:patente,:color,:marca)");
		//$consulta =$objetoAccesoDato->RetornarConsulta("CALL Insertarautomovil (:nombre,:apellido,:dni,:foto)");
		$consulta->bindValue(':patente',$automovil->patente, PDO::PARAM_STR);
		$consulta->bindValue(':color', $automovil->color, PDO::PARAM_STR);
		$consulta->bindValue(':marca', $automovil->marca, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();*/
}

?>