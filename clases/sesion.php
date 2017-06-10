<?php

class Sesion
{
	public static function ValidarLogin($parametros)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta("Select id_empleado from empleados where usuario = :valor1 and contraseña = :valor2");
	    $consulta->bindParam(":valor1",$parametros['usuario']);
	    $consulta->bindParam(":valor2",$parametros['contraseña']);
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
	
}