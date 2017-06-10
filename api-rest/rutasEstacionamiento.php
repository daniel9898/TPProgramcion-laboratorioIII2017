<?php
$app->get('/estacionamiento/{esDiscap}',function($request,$response) 
{
	$discap = $request->getAttribute('esDiscap');
	$lugarVacio = Estacionamiento::ObtenerPrimerLugarVacio($discap);
	
	if(isset($lugarVacio))
		Estacionamiento::CambiarElEstadoDeLaDisponibilidad($lugarVacio['MIN(id_lugar)'],"ocupado");

    return $response->withJson(array("idLugar"=>$lugarVacio['MIN(id_lugar)']));
});

$app->post('/estacionamiento/{idLugar}',function($request,$response) 
{
	$id = $request->getAttribute('idLugar');
	Estacionamiento::CambiarElEstadoDeLaDisponibilidad($id,"vacio");

    return $response->withJson(array("idLugar"=>$id),200);

});