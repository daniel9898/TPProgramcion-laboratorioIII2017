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

     return $response->withJson(array("respuesta"=>$resp,"idRegistro"=>$id),$status); 

});

$app->post('/cerrarRegistro/{id}',function($request,$response) 
{
    $idRegistro = $request->getAttribute('id');
    $horaIngreso = $request->getParam('horaAlta');
    //var_dump($horaIngreso);
    $horaEgreso = date('H:i:s d-m-Y');
    //var_dump($horaEgreso);
    $importe = RegistroFinal::CalcularMonto($horaIngreso,$horaEgreso);
    //var_dump($importe);
    $resp = RegistroFinal::SetearImporteYfechaDeSalida($idRegistro,$horaEgreso,$importe);
        
    $status = 200; 
    if(!$resp || !isset($importe))
       $status = 500;
    
    return $response->withJson(array("respuesta"=>$resp,"importe"=>$importe),$status);

});