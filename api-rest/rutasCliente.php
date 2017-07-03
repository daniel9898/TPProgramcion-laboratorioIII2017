<?php

$app->post('/clientes',function($request,$response) 
{
    $parametros = $request->getParams('nombre','apellido','dni');
    $resp = cliente::Insertar($parametros['nombre'],$parametros['apellido'],$parametros['dni']);
    $id = cliente::TraerUltimoIdAgregado();
    
    $status = 200; 
    if(!$resp || !isset($id))
      $status = 500;

    return $response->withJson(array("respuesta"=>$resp,"idCliente"=>$id));

});

$app->get('/traerVehiculos/{idCliente}',function($request,$response) 
{
  $id = $request->getAttribute('idCliente'); 
  $arrayAutos = cliente::TraerVehiculos($id);
  if($arrayAutos == null)
    $arrayAutos = false;

  return $response->withJson(array("respuesta"=>$arrayAutos));
});
