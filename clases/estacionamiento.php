<?php 

class Estacionamiento 
{
	public static function ObtenerPrimerLugarVacio($discap)
	{
       	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("select MIN(id_lugar) as lugarVacio,piso from lugares where disponibilidad = 'vacio' and discapacitados = :valor");
	    $consulta->bindParam(":valor",$discap);
	    $consulta->execute();
	    $lugarVacio = $consulta->fetch(PDO::FETCH_ASSOC);
	    return $lugarVacio;
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