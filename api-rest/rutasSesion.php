<?php 

$app->post('/abrirSesion',function($request,$response)
{
	$resp=false;
	$parametros = $request->getParams('usuario','contraseña');
    $usuariosContrasDb = Sesion::ObtenerDatosLogin(); 
    //print_r($usuariosContrasDb);
    $idEmp = Sesion::VerificarLogin($usuariosContrasDb,$parametros);
    //var_dump($idEmp);
    if($idEmp != false)
    {
    	Sesion::CambiarEstadoLogin($idEmp,"si");
    	$resp = true;
    }

    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus(200));
    $parsedBody->write(json_encode(array("respuesta"=>$resp,"idEmpleado"=>$idEmp)));

});

$app->post('/cerrarSesion/{id}',function($request,$response)
{
	$resp = false;
	$idEmp = $request->getAttribute('id');
	if(is_numeric($idEmp) && $idEmp > 0 && $idEmp < 4 )
	{
       $resp = Sesion::CambiarEstadoLogin($idEmp,"no");
       $status = 200;
	}
    else
       $status = 404;
    	
    $parsedBody = $response->getBody();
    $parsedBody->write($response->withHeader("Content-type", "application/json"));  
    $parsedBody->write($response->withStatus($status));
    $parsedBody->write(json_encode(array("respuesta"=>$resp)));

});