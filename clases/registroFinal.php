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
    
    public static function Cerrar($id_registro,$horaSalida,$importe)
    {
    	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta('update registro_final set hora_salida = :valor1,
        importe = :valor2
	    where id_operacion = :id');
	    $consulta->bindParam(":valor1",$horaSalida);
	    $consulta->bindParam(":valor2",$importe);
	    $consulta->bindParam(":id",$id_registro);
	    return $consulta->execute();
    }
    
    public static function CalcularMonto($fechaIngreso,$fechaEgreso)
    {
        $horaEntrada =explode(" ",$fechaIngreso);
        $horaSalida =explode(" ",$fechaEgreso);
        //echo $horaSalida[1];
		$minutos = RegistroFinal::dateDiff($horaEntrada[1],$horaSalida[1]);

        /*$valor12H = 90;
        $valor24H = 170;
		$valorHora = 10;
		$valorMinuto = $valorHora / 60;*/

		return $minutos;

		/*if()
		{

		}*/

    }

    public static function dateDiff($start,$end)
    {
		$start_ts = strtotime($start);
		$end_ts = strtotime($end);

		$diff = $end_ts - $start_ts;

		return round($diff / 60);
		/*$date = new DateTime(); 

        $date2 = new DateTime($start); 
         
        $date->setTimeZone( new DateTimeZone('America/Buenos_Aires') ); 

        $interval = $date->diff( $date2 ); 

        echo $interval->format('%h%');*/ 
    }

    public static function TraerRegistrosActivos()
    {
        $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta("select apellido,patente,hora_entrada,operaciones.id_operacion,id_registro,id_lugar
		from automovil inner join clientes on clientes.id_cliente=automovil.id_cliente 
		inner join registro_final on clientes.id_cliente=registro_final.id_cliente 
		inner join operaciones on clientes.id_cliente=operaciones.id_operacion
		where registro_final.hora_salida is NULL ");
		$consulta->execute();
	    $registros = $consulta->fetchAll();
	    return $registros;
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