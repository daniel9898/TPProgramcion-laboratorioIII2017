<?php
class Operacion
{
	
	public static function Insertar($id_cliente, $id_automovil,$id_lugar,$id_empleadoEntrada)
	{
		$idEmpleadoSalida = null;
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta("insert into operaciones
	     (id_cliente,id_automovil,id_lugar,id_empleadoEntrada,id_empleadoSalida) values(:idCliente,:idAuto,:idLugar,:idEmpEntra,:idEmpsal)");
	    $consulta->bindParam(":idCliente",$id_cliente);
	    $consulta->bindParam(":idAuto",$id_automovil);
	    $consulta->bindParam(":idLugar",$id_lugar);
	    $consulta->bindParam(":idEmpEntra",$id_empleadoEntrada);
	    $consulta->bindParam(":idEmpsal",$idEmpleadoSalida);
	    
	    return $consulta->execute();
	}
    
    public static function SetearEmpleadoSalida($idOperacion,$idEmpleadoSalida)
    {
    	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta('update operaciones set id_empleadoSalida = :valor where id_operacion = :id');
	    $consulta->bindParam(":valor",$idEmpleadoSalida);
	    $consulta->bindParam(":id",$idOperacion);
	    return $consulta->execute();
    }

    public static function TraerUltimoIdAgregado()
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("select id_operacion from operaciones order by id_operacion DESC limit 1");
	    $consulta->execute();
	    $idCliente = $consulta->fetchColumn(0);
	    return $idCliente;
	   
	}

	public static function VerificarSiClienteYautoEstanEstacionados($idCliente,$idAuto)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("select id_lugar from operaciones where id_cliente = :cliente and id_automovil= :auto and id_empleadoSalida is NULL");
	    $consulta->bindParam(":cliente",$idCliente);
	    $consulta->bindParam(":auto",$idAuto);
	    $consulta->execute();
	    $idOperacion = $consulta->fetchColumn(0);
	    return $idOperacion;
	   
	}

}
