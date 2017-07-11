<?php 
require_once 'empleados.php';
require_once 'IApiUsable.php';

class ApiEmpleado extends Empleado implements IApiUsable
{
	public function TraerUno($request, $response, $args)
	{
		$idEmp = $request->getAttribute('id');
		$empBuscado = array('respuesta' => false);
	   	$status = 404;
	   	//var_dump($idEmp);

	    if(is_numeric($idEmp))
	    {
	        $empBuscado = Empleado::Traer($idEmp); 
		    if(!empty($empBuscado))
		       $status = 200;
	    }
	    
	    return $response->withJson($empBuscado,$status);
    }

   	public function TraerTodos($request, $response, $args)
   	{
	    $empleados = Empleado::TraerTodosDB(); 
	    
	    $i=0;
	    foreach ($empleados as $valor)
	    {
	        $array[$i] = (array)$valor;
	        $i++;
	    }

	    return $response->withJson($array);
    }

    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParams('nombre','apellido','usuario','clave','cargo');
	    $resp = Empleado::Insertar($parametros['nombre'],$parametros['apellido'],$parametros['usuario'],$parametros['clave'],$parametros['cargo']);
	    $id = Empleado::TraerUltimoIdAgregado();
	    
	    $status = 200; 
	    if(!$resp || !isset($id))
	       $status = 500;

        return $response->withJson(array("respuesta"=>$resp,"idEmpleado"=>$id));
    }
    //Para borrar se pide el motivo y se graba la tabla de despedidos
   	public function BorrarUno($request, $response, $args)
   	{ 
   	    $parametros = $request->getparams('id','motivo');
	   	$status = 404;
	   	$resp = false;
	    $empOk = Empleado::Traer($parametros['id']);
	    //var_dump($empOk);

	    if(isset($empOk))
	    {
	    	Empleado::GuardarEmpleadosdespedidos($parametros['id'],$parametros['motivo'],
	    		$empOk->GetNombre(),$empOk->GetApellido());
                                          Empleado::ModificarRestriccionDeClaveForanea(0);
	    	 Empleado:: Despedir($parametros['id']);
                                          Empleado::ModificarRestriccionDeClaveForanea(1);
	    	$resp = true;
	    	$status = 200;
	    }

	    return $response->withJson(array('respuesta'=>$resp),$status);
   	}

   
   	public function ModificarUno($request, $response, $args)//PUT PARA SUSPENDER
   	{
   	    $parametros = $request->getparams('id','motivo','cantidadDias');
	   	$status = 404;
	   	$resp = false;
	    $empOk = Empleado::Traer($parametros['id']);

	    if(isset($empOk))
	    {
	    	Empleado::GuardarEmpleadosSuspendidos($parametros['id'],$parametros['motivo'],
	    		$empOk->GetNombre(),$empOk->GetApellido(),$parametros['cantidadDias']);
	    	Empleado::Suspender($parametros['id']);
	    	$resp = true;
	    	$status = 200;
	    }

	    return $response->withJson(array('respuesta'=>$resp),$status);
   	}
	
}

