<?php 

 $app->post('/abrirRegistro',function($request,$response) 
{
    $parametros = $request->getParams('idCliente','idOperacion','horaAlta');
    $resp = RegistroFinal::Insertar($parametros['idCliente'],$parametros['idOperacion'],
    	$parametros['horaAlta']);
    $id = RegistroFinal::TraerUltimoIdAgregado();
    
    $status = 200; 
    if(!$resp || !isset($id))
      $status = 500;

    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus($status));
    $parsedBody->write(json_encode(array("respuesta"=>$resp,"idRegistro"=>$id))); 

});