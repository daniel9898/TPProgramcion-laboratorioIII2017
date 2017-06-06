<?php

$app->post('/clientes',function($request,$response) 
{
    $parametros = $request->getParams('nombre','apellido','dni');
    $resp = cliente::Insertar($parametros['nombre'],$parametros['apellido'],$parametros['dni']);
    $id = cliente::TraerUltimoIdAgregado();
    
    $status = 200; 
    if(!$resp || !isset($id))
      $status = 500;

    $horaAlta = date('Y-m-d H-i-s');
  
    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus($status));
    $parsedBody->write(json_encode(array("respuesta"=>$resp,"idCliente"=>$id,"fecha"=>$horaAlta)));

});
