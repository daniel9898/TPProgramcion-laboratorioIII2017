<?php
require_once 'cliente.php';
class Automovil 
{
	public $id_automovil;
	public $patente;
 	public $color;
  	public $marca;
  	public $id_cliente;

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
	public function GetIdCliente()
	{
		return $this->id_cliente;
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
	public function SetIdCliente($valor)
	{
		$this->id_cliente = $valor;
	}


	public function TraerTodosDB()
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("SELECT * from automovil");
	    $consulta->execute();
	    $datos = $consulta->setFetchMode(PDO::FETCH_INTO,new Automovil);
	    return $consulta;
	   
	}

	public function Insertar($patente, $color,$marca,$id_cliente)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta("insert into automovil
	     (patente,color,marca,id_cliente) values(:patente,:color,:marca,:id_cliente)");
	    $consulta->bindParam(":patente",$patente);
	    $consulta->bindParam(":color",$color);
	    $consulta->bindParam(":marca",$marca);
	    $consulta->bindParam(":id_cliente",$id_cliente);
	    return $consulta->execute();
	}

	public function Eliminar($id)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta("delete from automovil where id_automovil = :id");
	    $consulta->bindParam(":id",$id);
	    return $consulta->execute();
	}

	public static function ComprobarSiExiste($id)
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

	public function Traer($id) 
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta('select * from automovil where id_automovil = '.$id.'');   
	    $consulta->execute();
	    $autoBuscado = $consulta->fetchObject('Automovil');
	    return $autoBuscado;    
	}

	public function Modificar($patente,$color,$marca,$id_cliente,$id)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta("
	                update automovil
	                set patente=:patente,
	                color=:color,
	                marca=:marca,
	                id_cliente =:id_cliente
	                WHERE id_automovil=:id");
	    $consulta->bindParam(":patente",$patente);
	    $consulta->bindParam(":color",$color);
	    $consulta->bindParam(":marca",$marca);
	    $consulta->bindParam(":id",$id);
	    $consulta->bindParam(":id_cliente",$id_cliente);
	    return $consulta->execute();
	}
    
    public static function TraerUltimoIdAgregado()
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("select id_automovil from automovil order by id_automovil DESC limit 1");
	    $consulta->execute();
	    $idAuto = $consulta->fetchColumn(0);
	    return $idAuto;
	}

	public static function ModificarRestriccionDeClaveForanea($flag)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("SET foreign_key_checks = ".$flag."");
	    return $consulta->execute();
	}

}

