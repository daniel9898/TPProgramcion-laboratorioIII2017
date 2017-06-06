<?php

$app->post('/altaOperacion',function($request,$response) 
{
    $parametros = $request->getParams('idCliente','idAutomovil','idLugar','idEmpleadoAlta');
    $resp = Operacion::Insertar($parametros['idCliente'],$parametros['idAutomovil'],
        $parametros['idLugar'],$parametros['idEmpleadoAlta']);
        
    $id = Operacion::TraerUltimoIdAgregado();
    
    $status = 200; 
    if(!$resp || !isset($id))
      $status = 500;
   
    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus($status));
    $parsedBody->write(json_encode(array("respuesta"=>$resp,"idOperacion"=>$id))); 

});

$app->post('/bajaOperacion/{id}',function($request,$response) 
{
	$id = $request->getAttribute('id');
    $idEmpSalida = $request->getParam('idEmpleadoSalida');
    $resp = Operacion::Cerrar($id,$idEmpSalida);
  
    $status = 200; 
    if(!$resp)
      $status = 500;
   
    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus($status));
    $parsedBody->write(json_encode(array("respuesta"=>$resp))); 

});