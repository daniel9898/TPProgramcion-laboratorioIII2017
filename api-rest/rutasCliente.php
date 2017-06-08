<?php

$app->post('/clientes',function($request,$response) 
{
    $parametros = $request->getParams('nombre','apellido','dni');
    $resp = cliente::Insertar($parametros['nombre'],$parametros['apellido'],$parametros['dni']);
    $id = cliente::TraerUltimoIdAgregado();
    
    $status = 200; 
    if(!$resp || !isset($id))
      $status = 500;

    $horaAlta = date('H:i:s d-m-Y');
  
    return $response->withJson(array("respuesta"=>$resp,"idCliente"=>$id,"fecha"=>$horaAlta));

});
