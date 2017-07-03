<?php

$app->post('/altaOperacion',function($request,$response) 
{
    $parametros = $request->getParams('idCliente','idAutomovil','idLugar','idEmpleadoAlta');
    $esta = Operacion::VerificarSiClienteYautoEstanEstacionados($parametros['idCliente'],
        $parametros['idAutomovil']);
    if($esta == null) 
    {
        $resp = Operacion::Insertar($parametros['idCliente'],$parametros['idAutomovil'],
        $parametros['idLugar'],$parametros['idEmpleadoAlta']);
        $id = Operacion::TraerUltimoIdAgregado();
        $horaAlta = date('H:i:s d-m-Y');
        $status = 200;  
    }
    else
        Estacionamiento::CambiarElEstadoDeLaDisponibilidad($parametros['idLugar'],"vacio"); 

    if($esta != null || !isset($id) || !$resp)
      $status = 500;
   
    return $response->withJson(array("respuesta"=>$resp,"idOperacion"=>$id,"horaAlta"=>$horaAlta,"lugar"=>$esta),$status); 

});

$app->post('/bajaOperacion/{id}',function($request,$response) 
{
	$id = $request->getAttribute('id');
    $idEmpSalida = $request->getParam('idEmpleadoSalida');
    $resp = Operacion::SetearEmpleadoSalida($id,$idEmpSalida);
  
    $status = 200; 
    if(!$resp)
      $status = 500;
   
    return $response->withJson(array("respuesta"=>$resp,"idOperacion"=>$id)); 

});