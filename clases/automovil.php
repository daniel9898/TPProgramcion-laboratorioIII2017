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

	public static function TraerRegistros()
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("SELECT * from automovil");
	    $consulta->execute();
	    $datos = $consulta->setFetchMode(PDO::FETCH_INTO,new Automovil);
	    return $consulta;
	   
	}

	public function InsertarRegistro($patente, $color,$marca)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta("insert into automovil (patente,color,marca) values(:patente,:color,:marca)");
	    $consulta->bindParam(":patente",$patente);
	    $consulta->bindParam(":color",$color);
	    $consulta->bindParam(":marca",$marca);
	    return $consulta->execute();
	}

	public function EliminarRegistro($id)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta("delete from automovil where id_automovil = :id");
	    $consulta->bindParam(":id",$id);
	    return $consulta->execute();
	}

	public function ComprobarSiExisteRegistro($id)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta("select count(id_automovil) from automovil where id_automovil = :id");
	    $consulta->bindParam(":id",$id);
	    $consulta->execute();
	    $res = $consulta->fetchColumn(0);
	    if($res)
	        return true;
	    else
	        return false;
	}

	public function TraerRegistro($id) 
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta('select * from automovil where id_automovil = '.$id.'');   
	    $consulta->execute();
	    $autoBuscado = $consulta->fetchObject('Automovil');
	    return $autoBuscado;    
	}

	public function ModificarRegistro($patente,$color,$marca,$id)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta("
	                update automovil
	                set patente=:patente,
	                color=:color,
	                marca=:marca
	                WHERE id_automovil=:id");
	    $consulta->bindParam(":patente",$patente);
	    $consulta->bindParam(":color",$color);
	    $consulta->bindParam(":marca",$marca);
	    $consulta->bindParam(":id",$id);
	    return $consulta->execute();
	}

	/*public function ModificarRegistro($campoAmodificar,$valor,$id)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta('update automovil set '.$campoAmodificar.' = :valor where id_automovil = :id');
	    $consulta->bindParam(":valor",$valor);
	    $consulta->bindParam(":id",$id);
	    return $consulta->execute();
	}*/
}

?>