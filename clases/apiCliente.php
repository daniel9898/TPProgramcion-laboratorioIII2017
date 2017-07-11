<?php

require_once 'cliente.php';

class ApiCliente extends Cliente
{
    public function TraerVehiculos($request, $response, $args)
	{
	  $id = $request->getAttribute('id');
	  //print_r($id); 
	  $arrayAutos = cliente::TraerVehiculosDB($id);
	  if($arrayAutos == null)
	     $arrayAutos = false;

	  return $response->withJson(array("respuesta"=>$arrayAutos));
	}

	public function CargarUno($request, $response, $args)
	{
	    $parametros = $request->getParams('nombre','apellido','dni');
	    $resp = cliente::Insertar($parametros['nombre'],$parametros['apellido'],$parametros['dni']);
	    $id = cliente::TraerUltimoIdAgregado();
	    
	    $status = 200; 
	    if(!$resp || !isset($id))
	      $status = 500;

	    return $response->withJson(array("respuesta"=>$resp,"idCliente"=>$id));
	}  
}