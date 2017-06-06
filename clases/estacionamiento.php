<?php 

class Estacionamiento 
{
	public static function TraerLugares()
	{
       	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("select * from lugares");
	    $consulta->execute();
	    $lugares = $consulta->fetchAll();
	    return $lugares;
	}

	public static function ObtenerPrimerLugarVacio($lugares,$discap)
	{
		if($discap == "si")
		{
			foreach ($lugares as $lugar)
			{
			   	if($lugar["disponibilidad"] == "vacio")
			   		return $lugar["id_lugar"];
			 
			   	if(key($lugar) == 2)
			   		break;
			}
		}
		else
		{
			foreach ($lugares as $lugar)
			{
			   	if($lugar["disponibilidad"] == "vacio" && $lugar["discapacitados"] == "no")
			   		return $lugar["id_lugar"];
			}

		}
		return false;
	}

	public static function CambiarElEstadoDeLaDisponibilidad($idlugar,$valor)
    {
    	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta('update lugares set disponibilidad = :valor where id_lugar = :id');
	    $consulta->bindParam(":valor",$valor);
	    $consulta->bindParam(":id",$idlugar);
	    return $consulta->execute();

    }
}