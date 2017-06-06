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
    
    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus(200));
    $parsedBody->write(json_encode($array));

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
	    {
	      $status = 200;
	    }
    }
    
    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus($status));
    $parsedBody->write(json_encode($autoBuscado)); 

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
    
    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus($status));
    $parsedBody->write(json_encode(array("respuesta"=>$resp))); 

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
    	
    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus($status));
    $parsedBody->write(json_encode(array('respuesta'=>$resp))); 

});

$app->get('/vehiculosMod/{id}',function($request,$response) 
{
    $idAuto = $request->getAttribute('id');
    $parametros = $request->getParams('patente','color','marca','idCliente');
   	$status = 404;
   	$resp = false;
    var_dump($idAuto);
    $existeAuto = Automovil::ComprobarSiExiste($idAuto);
    var_dump($parametros['idCliente']);
    $existeCliente = Cliente::ComprobarSiExiste($parametros['idCliente']);
    
    if(is_numeric($idAuto) && $existeAuto && $existeCliente)
    {
    	Automovil::Modificar($parametros['patente'],$parametros['color'],$parametros['marca'],
            $parametros['idCliente'],$idAuto);
    	$resp = true;
    	$status = 200;
    }
    	
    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus($status));
    $parsedBody->write(json_encode(array('respuesta'=>$resp))); 

});


