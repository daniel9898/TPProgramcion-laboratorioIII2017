<?php 

$app->get('/vehiculos',function($request,$response)
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
    
    $consulta = $objetoAcceso->RetornarConsulta("SELECT * from automovil");
    $consulta->execute();
    $arrayVehiculos = $consulta->fetchAll(PDO::FETCH_ASSOC);
   
    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus(200));
    $parsedBody->write(json_encode($arrayVehiculos)); 

});

$app->get('/vehiculos/{id}',function($request,$response)
{
	$idAuto = $request->getAttribute('id');
	$autoBuscado = array('respuesta' => false);
   	$status = 404;

    if(is_numeric($idAuto))
    {
    	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
        $consulta = $objetoAcceso->RetornarConsulta('select patente,color,marca from automovil where id_automovil = '.$idAuto.''); 
        $consulta->execute();
        $autoBuscado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
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
    $parametros = $request->getParams('patente','color','marca');
    $resp = InsertarRegistro($parametros['patente'],$parametros['color'],$parametros['marca']);
 
    $status = 200; 
    if(!$resp)
      $status = 500;

    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus($status));
    $parsedBody->write(json_encode(array("respuesta"=>$resp))); 

});

$app->delete('/vehiculos/{id}',function($request,$response) 
{
    $idAuto = $request->getAttribute('id');
   	$status = 404;
   	$resp = false;
    $existe = ComprobarSiExisteRegistro($idAuto);
 
    if(is_numeric($idAuto) && $existe)
    {
    	EliminarRegistro($idAuto);
    	$resp = true;
    	$status = 200;
    }
    	
    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus($status));
    $parsedBody->write(json_encode(array('respuesta'=>$resp))); 

});

$app->put('/vehiculos/{id}',function($request,$response) 
{
    $idAuto = $request->getAttribute('id');
    $parametros = $request->getParams('patente','color','marca');
   	$status = 404;
   	$resp = false;
    $existe = ComprobarSiExisteRegistro($idAuto);
  
    if(is_numeric($idAuto) && $existe)
    {
    	ModificarRegistro($parametros['patente'],$parametros['color'],$parametros['marca'],$idAuto);
    	$resp = true;
    	$status = 200;
    }
    	
    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus($status));
    $parsedBody->write(json_encode(array('respuesta'=>$resp))); 

});


 ?>