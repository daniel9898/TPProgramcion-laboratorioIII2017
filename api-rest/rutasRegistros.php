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

$app->post('/cerrarRegistro/{id}',function($request,$response) 
{
    $idRegistro = $request->getAttribute('id');
    $horaIngreso = $request->getParam('horaAlta');
    $horaEgreso = date('Y-m-d H-i-s');
    $dif = RegistroFinal::CalcularMonto($horaIngreso,$horaEgreso);
    echo $dif/3600;
    //$resp = RegistroFinal::Cerrar($idRegistro,$horaEgreso,$importe);
        
    //$status = 200; 
    //if(!$resp || !isset($importe))
    //  $status = 500;

    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    //$parsedBody->write($response->withStatus($status));
    //$parsedBody->write(json_encode(array("respuesta"=>$resp,"importe"=>$importe))); 

});