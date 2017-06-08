<?php 

class Estacionamiento 
{
	public static function TraerLugares()
	{
       	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("select id_lugar,discapacitados from lugares where disponibilidad = 'vacio'");
	    $consulta->execute();
	    $lugares = $consulta->fetchAll();
	    return $lugares;
	}

	public static function ObtenerPrimerLugarVacio($lugares,$discap)
	{
		if(count($lugares)>0)
		{
			if($discap == "si")//si se agotan los lugares retornamos otro igual 
			   		return $lugares[0]["id_lugar"];
			else
			{
				foreach ($lugares as $lugar)
				{
				   	if($lugar["discapacitados"] == "no")
				   		return $lugar["id_lugar"];
				}

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