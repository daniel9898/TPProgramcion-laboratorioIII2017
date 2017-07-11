<?php
require_once 'sesion.php';

class ApiSesion extends Sesion
{
	public function TraerSesiones($request, $response, $args)
	{
        $resp = false;
	    $status = 200;
	    $fechas = $request->getParams('desde','hasta');

	    if(!isset($fechas['hasta']))
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
    }

    public function AbrirSesion($request, $response, $args)
	{
        $resp=false;
	    $idLogin=false;
	    $token=false;
	    $parametros = $request->getParams('usuario','clave');

	    $id = Sesion::ValidarLogin($parametros); 
	    
	    if($id["id_empleado"] != false)
	    {
	      $inicioSesion = date('Y-m-d H:i:s');
	      Sesion::GrabarFechaInicio($id["id_empleado"],$inicioSesion);
	    	Sesion::CambiarEstadoLogin($id["id_empleado"],"si");
	      $idLogin = Sesion::TraerUltimoIdAgregado();
	      //Creamos el token
	      $token= AutentificadorJWT::CrearToken(array("perfil"=>$parametros['usuario'])); 
	    	$resp = true;
	    }
	    return $response->withJson(array("respuesta"=>$resp,"idEmpleado"=>$id["id_empleado"],
	    	                             "idLogin"=>$idLogin,"token"=>$token),200);
    }

    public function CerrarSesion($request, $response, $args)
	{
		$resp = false;
	    $parametros = $request->getParams('idLog','idEmp');//HAY QUE MODIFICAR EL FRONT
		if(is_numeric($parametros['idEmp']) && $parametros['idEmp'] > 0 && $parametros['idEmp'] < 4 )
		{
	      $cierreSesion = date('Y-m-d H:i:s');
	      Sesion::GrabarFechaDeCierre($cierreSesion,$parametros['idLog']);
	      $resp = Sesion::CambiarEstadoLogin($parametros['idEmp'],"no");
	      $status = 200;
		}
	    else
	    $status = 404;
	    	
	    return $response->withJson(array("respuesta"=>$resp),$status);
    }
}