<?php

class Sesion
{
	public static function ValidarLogin($parametros)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta("Select id_empleado from empleados where usuario = :valor1 and contraseña = :valor2");
	    $consulta->bindParam(":valor1",$parametros['usuario']);
	    $consulta->bindParam(":valor2",$parametros['clave']);
	    $consulta->execute();
	    $id = $consulta->fetch(PDO::FETCH_ASSOC);  
	    return $id;
	}
    
    public static function CambiarEstadoLogin($idEmp,$valor)
    {
    	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta('update empleados set Esta_logeado = :valor where id_empleado = :id');
	    $consulta->bindParam(":valor",$valor);
	    $consulta->bindParam(":id",$idEmp);
	    return $consulta->execute();

    }

    public static function GrabarFechaInicio($idEmp,$fechaInicio)
    {
    	$fechaCierre = null;
    	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta('insert into logins
	     (id_empleado,fecha_apertura,fecha_cierre) values(:idEmp,:fechaI,:fechaS)');
	    $consulta->bindParam(":idEmp",$idEmp);
	    $consulta->bindParam(":fechaI",$fechaInicio);
	    $consulta->bindParam(":fechaS",$fecha_cierre);
	    return $consulta->execute();
    }

    public static function GrabarFechaDeCierre($fechaCierre,$idLogin)
    {
    	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta('update logins set fecha_cierre = :valor 
	    	where id_login=:id');
	    $consulta->bindParam(":valor",$fechaCierre);
	    $consulta->bindParam(":id",$idLogin);
	    return $consulta->execute();
    }

    public static function TraerUltimoIdAgregado()
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta("select id_login from logins order by id_login DESC limit 1");
	    $consulta->execute();
	    $id = $consulta->fetchColumn(0);
	    return $id;
	}

	public static function TraerloginsPorFecha($desde,$hasta)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta("Select id_login,id_empleado,fecha_apertura,fecha_cierre From logins WHERE fecha_apertura BETWEEN :fecha1 AND :fecha2");
	    $consulta->bindParam(":fecha1",$desde);
	    $consulta->bindParam(":fecha2",$hasta);
	    $consulta->execute();
	    $logins = $consulta->fetchall(PDO::FETCH_ASSOC);
	    return $logins;
	}
	
}