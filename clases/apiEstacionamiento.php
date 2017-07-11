<?php 
require_once 'estacionamiento.php';

class ApiEstacionamiento extends Estacionamiento
{
	public function TraerLugarVacio($request, $response, $args)
	{
	    $discap = $request->getAttribute('esDiscap');
		$lugarVacio = Estacionamiento::ObtenerPrimerLugarVacio($discap);
		
		if(isset($lugarVacio))
			Estacionamiento::CambiarElEstadoDeLaDisponibilidad($lugarVacio['lugarVacio'],"ocupado");

	    return $response->withJson(array("idLugar"=>$lugarVacio));//el fronted hay que modif
    }

    public function LiberarLugar($request, $response, $args)
	{
		$id = $request->getAttribute('idLugar');
		Estacionamiento::CambiarElEstadoDeLaDisponibilidad($id,"vacio");

	    return $response->withJson(array("idLugar"=>$id),200);
    }
}