<?php 

$app->post('/abrirSesion',function($request,$response)
{
	$resp=false;
	$parametros = $request->getParams('usuario','clave');
    $id = Sesion::ValidarLogin($parametros); 
    
    if($id["id_empleado"] != false)
    {
    	Sesion::CambiarEstadoLogin($id["id_empleado"],"si");
    	$resp = true;
    }
    return $response->withJson(array("respuesta"=>$resp,"idEmpleado"=>$id["id_empleado"]),200);
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