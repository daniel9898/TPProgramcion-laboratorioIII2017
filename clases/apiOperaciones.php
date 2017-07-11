<?php
require_once 'operacion.php';
require_once 'IApiUsable.php';

class ApiOperacion extends Operacion implements IApiUsable
{
	public function TraerUno($request, $response, $args)
	{
	 	$fechas = $request->getParams('desde','hasta','idEmp');
	    $operaciones = Operacion::TraerOperacionesPorEmpleado($fechas);
	    //var_dump($cantidad);
	    if(!isset($operaciones))
	    {
	        $objDelaRespuesta= new stdclass();
	        $objDelaRespuesta->error="El empleado no tiene operaciones en la fecha indicada.";
	        $NuevaRespuesta = $response->withJson($objDelaRespuesta, 500); 
	    }
	    else
	    {
	        $NuevaRespuesta = $response->withJson(array("Cantidad"=>count($operaciones),
	        	"Operaciones"=>$operaciones),200); 
	    }     
	    return $NuevaRespuesta;
    }


    public function CargarUno($request, $response, $args)
    {
	    $parametros = $request->getParams('idCliente','idAutomovil','idLugar','idEmpleadoAlta');
	    $esta = Operacion::VerificarSiClienteYautoEstanEstacionados($parametros['idCliente'],
	        $parametros['idAutomovil']);

	    $resp = false;
	    $id = false;
	    $horaAlta = false;
	    
	    if($esta == null) 
	    {
	        $resp = Operacion::Insertar($parametros['idCliente'],$parametros['idAutomovil'],
	        $parametros['idLugar'],$parametros['idEmpleadoAlta']);
	        $id = Operacion::TraerUltimoIdAgregado();
	        $horaAlta = date('H:i:s d-m-Y');
	        $status = 200;  
	    }
	    else
	        Estacionamiento::CambiarElEstadoDeLaDisponibilidad($parametros['idLugar'],"vacio"); 

	    if($esta != null || !isset($id) || !$resp)
	      $status = 500;
	   
	    return $response->withJson(array("respuesta"=>$resp,"idOperacion"=>$id,"horaAlta"=>$horaAlta,"estaEstacionado"=>$esta),$status); 
    }
   	public function BorrarUno($request, $response, $args)
   	{
	    $parametros = $request->getParams('id','idEmpleadoSalida');
	    $resp = Operacion::SetearEmpleadoSalida($parametros['id'],$parametros['idEmpleadoSalida']);
	  
	    $status = 200; 
	    if(!$resp)
	      $status = 500;
	   
	    return $response->withJson(array("respuesta"=>$resp,"idOperacion"=>$parametros['id'])); 
   	}

   	public function ModificarUno($request, $response, $args)
   	{}
                    public function TraerTodos($request, $response, $args)
   	{ }
   	
}