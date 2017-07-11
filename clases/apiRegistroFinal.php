<?php
require_once 'registroFinal.php';

class ApiRegistroFinal extends RegistroFinal
{
	public function TraerInforme($request, $response, $args)
	{
      $fechas = $request->getParams('desde','hasta');
      $informe = RegistroFinal::TraerInformeDB($fechas);

      return $response->withJson($informe);
	}

	public function AbrirRegistro($request, $response, $args)
	{
	    $parametros = $request->getParams('idCliente','idOperacion','horaAlta');
	    $resp = RegistroFinal::Insertar($parametros['idCliente'],$parametros['idOperacion'],
	    	$parametros['horaAlta']);
	    $id = RegistroFinal::TraerUltimoIdAgregadoDB();
	    
	    $status = 200; 
	    if(!$resp || !isset($id))
	      $status = 500;

	    return $response->withJson(array("respuesta"=>$resp,"idRegistro"=>$id),$status); 
	}
	
    public function CerrarRegistro($request, $response, $args)
	{
	    $idRegistro = $request->getAttribute('id');
	    //print_r($idRegistro);
	    $horaIngreso = $request->getParam('horaAlta');
	    $horaEgreso = date('Y-m-d H:i:s');
	    $importe = RegistroFinal::CalcularMonto($horaIngreso,$horaEgreso);
	    $resp = RegistroFinal::SetearImporteYfechaDeSalida($idRegistro,$horaEgreso,$importe);
	        
	    $status = 200; 
	    if(!$resp || !isset($importe))
	       $status = 500;
	    
	    return $response->withJson(array("respuesta"=>$resp,"importe"=>$importe),$status);
	}
	
}