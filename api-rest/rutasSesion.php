<?php 

$app->post('/abrirSesion',function($request,$response)
{
	$resp=false;
  $idLogin=false;
	$parametros = $request->getParams('usuario','clave');
  $id = Sesion::ValidarLogin($parametros); 
    
    if($id["id_empleado"] != false)
    {
      $inicioSesion = date('Y-m-d H:i:s');
      Sesion::GrabarFechaInicio($id["id_empleado"],$inicioSesion);
    	Sesion::CambiarEstadoLogin($id["id_empleado"],"si");
      $idLogin = Sesion::TraerUltimoIdAgregado();
    	$resp = true;
    }
    return $response->withJson(array("respuesta"=>$resp,"idEmpleado"=>$id["id_empleado"],"idLogin"=>$idLogin),200);
});

$app->post('/cerrarSesion/{id}',function($request,$response)
{
	$resp = false;
	$idEmp = $request->getAttribute('id');
  $idLog = $request->getParam('idLog');
	if(is_numeric($idEmp) && $idEmp > 0 && $idEmp < 4 )
	{
      $cierreSesion = date('Y-m-d H:i:s');
      Sesion::GrabarFechaDeCierre($cierreSesion,$idLog);
      $resp = Sesion::CambiarEstadoLogin($idEmp,"no");
      $status = 200;
	}
  else
    $status = 404;
    	
  return $response->withJson(array("respuesta"=>$resp),$status);

});

$app->get('/TraerSesiones',function($request,$response)
{
  $resp = false;
  $status = 200;
  $fechas = $request->getParams('desde','hasta');

  if(!isset($fechas['hasta']))//METERLO EN UNA FUNCION
  {
    $largo = strlen($fechas['desde']);
    $fechas['hasta'] = str_replace($fechas['desde'][$largo-1],$fechas['desde'][$largo-1]+1,
                                   $fechas['desde']);
  }
  else
  {
    $largo = strlen($fechas['hasta']);
    $fechas['hasta'] = str_replace($fechas['hasta'][$largo-1],$fechas['hasta'][$largo-1]+1,
                                   $fechas['hasta']);
  }

  $logins = Sesion::TraerloginsPorFecha($fechas['desde'],$fechas['hasta']);
      
  return $response->withJson(array("logins"=>$logins),$status);

});