<?php 

$app->get('/vehiculos',function($request,$response)
{
    $vehiculos = Automovil::TraerTodos(); 
    
    $i=0;
    foreach ($vehiculos as $valor)
    {
        $array[$i] = (array)$valor;
        $i++;
    }

    return $response->withJson($array);
});

$app->get('/vehiculos/{id}',function($request,$response)
{
	$idAuto = $request->getAttribute('id');
	$autoBuscado = array('respuesta' => false);
   	$status = 404;

    if(is_numeric($idAuto))
    {
        $autoBuscado = Automovil::Traer($idAuto); 
	    if(!empty($autoBuscado))
	       $status = 200;
    }
    
    return $response->withJson($autoBuscado,$status); 
});

$app->post('/vehiculos',function($request,$response) 
{
    $status = 200;
    $resp = false;
    $parametros = $request->getParams('patente','color','marca','idCliente');
    $existe = false;
    if(is_numeric($parametros['idCliente']) && Cliente::ComprobarSiExiste($parametros['idCliente']))
       $resp = Automovil::Insertar($parametros['patente'],$parametros['color'],$parametros['marca'],
        $parametros['idCliente']);
    else
        $status = 404;
    
    return $response->withJson(array("respuesta"=>$resp),$status); 
});

$app->get('/vehiculosBaja/{id}',function($request,$response) 
{
    $idAuto = $request->getAttribute('id');
   	$status = 404;
   	$resp = false;
    $existe = Automovil::ComprobarSiExiste($idAuto);
 
    if(is_numeric($idAuto) && $existe)
    {
    	Automovil::Eliminar($idAuto);
    	$resp = true;
    	$status = 200;
    }

    return $response->withJson(array('respuesta'=>$resp),$status);
});

$app->get('/vehiculosMod/{id}',function($request,$response) 
{
    $idAuto = $request->getAttribute('id');
    $parametros = $request->getParams('patente','color','marca','idCliente');
   	$status = 404;
   	$resp = false;
    $existeAuto = Automovil::ComprobarSiExiste($idAuto);
    $existeCliente = Cliente::ComprobarSiExiste($parametros['idCliente']);
    
    if(is_numeric($idAuto) && $existeAuto && $existeCliente)
    {
    	Automovil::Modificar($parametros['patente'],$parametros['color'],$parametros['marca'],
            $parametros['idCliente'],$idAuto);
    	$resp = true;
    	$status = 200;
    }
    
    return $response->withJson(array('respuesta'=>$resp),$status); 
});


