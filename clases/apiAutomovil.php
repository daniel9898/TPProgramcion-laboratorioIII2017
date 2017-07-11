<?php 
require_once 'automovil.php';
require_once 'IApiUsable.php';

class ApiAutomovil extends Automovil implements IApiUsable
{
	public function TraerTodos($request, $response, $args)
	{
        $vehiculos = Automovil::TraerTodosDB(); 
	    $i=0;
	    foreach ($vehiculos as $valor)
	    {
	        $array[$i] = (array)$valor;
	        $i++;
	    }

        return $response->withJson($array);
	} 

   	public function TraerUno($request, $response, $args)
   	{
       	$idAuto = $request->getAttribute('id');
		$autoBuscado = array('respuesta' => false);
	   	$status = 404;

	    if(is_numeric($idAuto))
	    {
	        $autoBuscado = Automovil::Traer($idAuto); 
		    if(!empty($autoBuscado))
		       $status = 200;
	    }
    
        return $response->withJson($autoBuscado,$status); 
   	} 

   	public function CargarUno($request, $response, $args)
   	{
        $status = 200;
	    $resp = false;
	    $parametros = $request->getParams('patente','color','marca','idCliente');
	    $existe = false;
	    if(is_numeric($parametros['idCliente']) && Cliente::ComprobarSiExisteCliente($parametros['idCliente']))
	       $resp = Automovil::Insertar($parametros['patente'],$parametros['color'],$parametros['marca'],
	        $parametros['idCliente']);
	    else
	        $status = 404;

	    $id = Automovil::TraerUltimoIdAgregado();
	    
	    return $response->withJson(array("respuesta"=>$resp,"idAuto"=>$id),$status); 
   	}

   	public function BorrarUno($request, $response, $args)
   	{
        $idAuto = $request->getAttribute('id');
	   	$status = 404;
	   	$resp = false;
	    //$existe = Automovil::ComprobarSiExiste($idAuto);
	 
	    if(is_numeric($idAuto))
	    {
	    	Automovil::ModificarRestriccionDeClaveForanea(0);
	    	Automovil::Eliminar($idAuto);
	    	$resp = true;
	    	$status = 200;
	    	Automovil::ModificarRestriccionDeClaveForanea(1);
	    }

        return $response->withJson(array('respuesta'=>$resp),$status);
   	}

   	public function ModificarUno($request, $response, $args)
   	{
   		$idAuto = $request->getAttribute('id');
	    $parametros = $request->getParams('patente','color','marca','idCliente');
	   	$status = 404;
	   	$resp = false;
	    $existeAuto = Automovil::ComprobarSiExiste($idAuto);
	    $existeCliente = Cliente::ComprobarSiExisteCliente($parametros['idCliente']);
	    
	    if(is_numeric($idAuto) && $existeAuto && $existeCliente)
	    {
	    	Automovil::Modificar($parametros['patente'],$parametros['color'],$parametros['marca'],
	            $parametros['idCliente'],$idAuto);
	    	$resp = true;
	    	$status = 200;
	    }
	    
	    return $response->withJson(array('respuesta'=>$resp),$status); 
   	}
	
}