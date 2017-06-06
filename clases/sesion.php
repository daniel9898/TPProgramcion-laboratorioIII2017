<?php

class Sesion
{
	public static function ObtenerDatosLogin()
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta("Select id_empleado,usuario,contraseña
	     from empleados");
	    $consulta->execute();
	    $datos = $consulta->fetchAll();  
	    return $datos;
	}
    
    public static function CambiarEstadoLogin($idEmp,$valor)
    {
    	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta('update empleados set Esta_logeado = :valor where id_empleado = :id');
	    $consulta->bindParam(":valor",$valor);
	    $consulta->bindParam(":id",$idEmp);
	    return $consulta->execute();

    }

    public static function VerificarLogin($usuariosContraseñas,$datosIngresados)
	{
	    foreach ($usuariosContraseñas as $valor)
	    {
	        if($valor[1] == $datosIngresados['usuario']  && $valor[2]== $datosIngresados['contraseña'])
	        {
	        	return $valor[0];
	        }
	    }
	    return false;
	   
	}
	
}