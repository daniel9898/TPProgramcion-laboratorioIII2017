<?php 

require_once 'cochera.php';

class ApiCochera extends Cochera
{
	public function TraerMasUtilizada($request, $response, $args)
	{
      $fechas = $request->getParams('desde','hasta');
      $cocherasUsadas = Cochera::TraerCocherasUtilizadas($fechas);
    
      $cantidadMaxOper[0] = $cocherasUsadas[0]["cantidad"];//la primera cochera tiene mayor cantidad
      
      for($i=0; $i<count($cocherasUsadas); $i++)
      {
      	if($cocherasUsadas[$i]["cantidad"] == $cantidadMaxOper[0])
      	{
      		$cantidadMaxOper[$i] = $cocherasUsadas[$i]["cantidad"];
          $idMax[$i] = $cocherasUsadas[$i]["lugar"];
          $pisoMax[$i] = Cochera::TraerPisoPorId($idMax[$i]); 
      	}
      }
      
      for ($i=0; $i<count($idMax) ; $i++)
      { 
        if(array_key_exists($i,$idMax))
        {
          $respuesta[$i]["LugarMasUtilizado"] = $idMax[$i]; 
          $respuesta[$i]["piso"] = $pisoMax[$i];
          $respuesta[$i]["cantidad"] = $cantidadMaxOper[$i];
        }
      }
      return $response->withJson($respuesta);
    }

  public function TraerMenosUtilizada($request, $response, $args)
	{
      $fechas = $request->getParams('desde','hasta');
      $cocherasUsadas = Cochera::TraerCocherasUtilizadas($fechas);
      //la ultima cochera tiene menor cantidad
      $cantidadMinOper[0] = $cocherasUsadas[count($cocherasUsadas)-1]["cantidad"];
   
      for($i=0; $i<count($cocherasUsadas); $i++)
      {
        if($cocherasUsadas[$i]["cantidad"] == $cantidadMinOper[0])
        {
          $cantidadMinOper[$i] = $cocherasUsadas[$i]["cantidad"];
          $idMin[$i] = $cocherasUsadas[$i]["lugar"];
          $pisoMin[$i] = Cochera::TraerPisoPorId($idMin[$i]);
        }
      }
      for ($i=0; $i<=count($idMin) ; $i++)
      { 
          $respuesta[$i]["LugarMenosUtilizado"] = $idMin[$i]; 
          $respuesta[$i]["piso"] = $pisoMin[$i];
          $respuesta[$i]["cantidad"] = $cantidadMinOper[$i];
      }
      array_splice($respuesta,0,1);//borro la primer pos que solo la use para saber cual es el MIN
      return $response->withJson($respuesta);
  }

  public function TraerCocherasSinUso($request, $response, $args)
	{
      $fechas = $request->getParams('desde','hasta');
      $lugares = Cochera::TraerPisosYcocheras();
      $lugaresUsados = Cochera::TraerCocherasUtilizadas($fechas);

      $lugarSinPiso = array_column($lugares,'lugar');
      $pisoSinLugar = array_column($lugares,'piso');
      
      for ($i=0; $i<count($lugaresUsados); $i++)
      { 
        if($indice = array_search($lugaresUsados[$i]["lugar"],$lugarSinPiso))
        {
          array_splice($lugarSinPiso,$indice,1);
          array_splice($pisoSinLugar,$indice,1);
        }   
      }

      for ($i=0; $i<count($lugarSinPiso); $i++)
      { 
        $noUsados[$i]['lugar']=$lugarSinPiso[$i];
        $noUsados[$i]['piso']=$pisoSinLugar[$i];   
      }

      return $response->withJson($noUsados); 
  }
	
}