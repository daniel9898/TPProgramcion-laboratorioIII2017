<?php

class RegistroFinal
{
	public static function Insertar($id_cliente, $id_operacion,$horaAlta)
	{
		$horaSalida = null;
		$importe = null;
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta("insert into registro_final
	     (id_cliente,id_operacion,hora_entrada,hora_salida,importe) values(:idCliente,:ideOper,:horaEntrada,:horaSalida,:importe)");
	    $consulta->bindParam(":idCliente",$id_cliente);
	    $consulta->bindParam(":ideOper",$id_operacion);
	    $consulta->bindParam(":horaEntrada",$horaAlta);
	    $consulta->bindParam(":horaSalida",$horaSalida);
	    $consulta->bindParam(":importe",$importe);
	    
	    return $consulta->execute();
	}
    
    /*public static function Cerrar($idOperacion,$idEmpleadoSalida)
    {
    	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta('update operaciones set id_empleadoSalida = :valor where id_operacion = :id');
	    $consulta->bindParam(":valor",$idEmpleadoSalida);
	    $consulta->bindParam(":id",$idOperacion);
	    return $consulta->execute();

    }*/

    public static function TraerRegistrosActivos()
    {
    	
    }



    public static function TraerUltimoIdAgregado()
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("select id_registro from registro_final order by id_registro DESC limit 1");
	    $consulta->execute();
	    $id = $consulta->fetchColumn(0);
	    return $id;
	   
	}
	
}