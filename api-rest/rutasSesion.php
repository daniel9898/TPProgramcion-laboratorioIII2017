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

    return $response->withJson(array("respuesta"=>$resp,"idEmpleado"=>$idEmp),200);

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
    	
    return $response->withJson(array("respuesta"=>$resp),$status);

});