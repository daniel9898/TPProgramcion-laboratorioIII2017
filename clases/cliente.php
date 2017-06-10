<?php 
class Cliente 
{
	public static function TraerUltimoIdAgregado()
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("select id_cliente from clientes order by id_cliente DESC limit 1");
	    $consulta->execute();
	    $idCliente = $consulta->fetchColumn(0);
	    return $idCliente;
	   
	}

	public function Insertar($nombre, $apellido,$dni)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta("insert into clientes (nombre,apellido,dni) values(:nombre,:apellido,:dni)");
	    $consulta->bindParam(":nombre",$nombre);
	    $consulta->bindParam(":apellido",$apellido);
	    $consulta->bindParam(":dni",$dni);
	    return $consulta->execute();
	}

	public function ComprobarSiExiste($id)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta("select count(id_cliente) from clientes where id_cliente = :id");
	    $consulta->bindParam(":id",$id);
	    $consulta->execute();
	    $res = $consulta->fetchColumn(0);
	    if($res)
	        return true;
	    else
	        return false;
	}

}
