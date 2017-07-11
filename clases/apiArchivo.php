<?php

class ApiArchivo
{
	public function GuardarArchivoEnServidor($request, $response, $args)
	{
       	try{

			$archivo = $_FILES["archivo"];
			$resp = ApiArchivo::GuardarArchivoEnDb($archivo);
	   }
	   catch(PDOException $e)
	   {
		 echo "Error: " . $e->getMessage();
	   }

     return $response->withJson(array("archivo"=>$resp));
	}

	Public static function GuardarArchivoEnDb($binario)
	{
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta("insert into archivos (binario) values(:v)");
		//$consulta->quote($binario);
		$consulta->bindParam(":v",$binario);
		return $consulta->execute();
	}

	Public function TraerArchivo($request, $response, $args)
	{
		$id = $request->getAttribute('id');
		$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
		$consulta = $objetoAcceso->RetornarConsulta("select binario from archivos where id_archivo=:id");
        $consulta->bindParam(":id",$id);
        $consulta->execute();
        $consulta->bindColumn(2, $data, PDO::PARAM_LOB);
 
        /* FETCH_BOUND: devuelve TRUE y asigna los valores de las columnas definidas anteriormente con bindColumn*/
        $consulta->fetch(PDO::FETCH_BOUND);
	    return $data;
	}

}