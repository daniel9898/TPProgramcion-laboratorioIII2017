<?php
$app->get('/estacionamiento/{esDiscap}',function($request,$response) 
{
	$discap = $request->getAttribute('esDiscap');
	$lugares = Estacionamiento::TraerLugares();
	$lugarvacio = Estacionamiento::ObtenerPrimerLugarVacio($lugares,$discap);
	if($lugarvacio != false)
		Estacionamiento::CambiarElEstadoDeLaDisponibilidad($lugarvacio,"ocupado");

    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus(200));
    $parsedBody->write(json_encode(array("idLugar"=>$lugarvacio)));

});