<?php
$app->get('/estacionamiento/{esDiscap}',function($request,$response) 
{
	$discap = $request->getAttribute('esDiscap');
	$lugares = Estacionamiento::TraerLugares();
	$lugarvacio = Estacionamiento::ObtenerPrimerLugarVacio($lugares,$discap);

	if($lugarvacio != false)
		Estacionamiento::CambiarElEstadoDeLaDisponibilidad($lugarvacio,"ocupado");

    return $response->withJson(array("idLugar"=>$lugarvacio));

});

$app->post('/estacionamiento/{idLugar}',function($request,$response) 
{
	$id = $request->getAttribute('idLugar');
	Estacionamiento::CambiarElEstadoDeLaDisponibilidad($id,"vacio");

    return $response->withJson(array("idLugar"=>$id),200);

});