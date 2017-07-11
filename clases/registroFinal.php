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
    
    public static function SetearImporteYfechaDeSalida($id_registro,$horaSalida,$importe)
    {
    	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta('update registro_final set hora_salida = :valor1,
        importe = :valor2
	    where id_registro = :id');
	    $consulta->bindParam(":valor1",$horaSalida);
	    $consulta->bindParam(":valor2",$importe);
	    $consulta->bindParam(":id",$id_registro);
	    return $consulta->execute();
    }
    
    public static function CalcularMonto($fechaIngreso,$fechaEgreso)
    {
		$minutos = RegistroFinal::CalcularDiferenciaHoraria($fechaIngreso,$fechaEgreso);
        
        $monto =  floor($minutos / 1440)*170;
        $monto += floor($minutos % 1440)*90;
        $monto += ((($minutos % 1440) %720)/60)*10;
	
		return round($monto); 	
    }

    public static function CalcularDiferenciaHoraria($start,$end)
    {
		$start_ts = strtotime($start);
		$end_ts = strtotime($end);

		$diff = $end_ts - $start_ts;
		return floor($diff / 60);
    }

    public static function TraerRegistrosActivos()
    {

       $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta("select apellido,patente,hora_entrada,registro_final.id_operacion,id_registro,operaciones.id_lugar
		from clientes inner join automovil on clientes.id_cliente=automovil.id_cliente 
		inner join operaciones on clientes.id_cliente=operaciones.id_cliente 
		inner join registro_final on clientes.id_cliente=registro_final.id_cliente
		where operaciones.id_empleadoSalida is NULL and registro_final.hora_salida is NULL
		and automovil.id_automovil=operaciones.id_automovil");
		$consulta->execute();
	    $registros = $consulta->fetchAll();
	    return $registros;
    }

    public static function TraerUltimoIdAgregadoDB()
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("select id_registro from registro_final order by id_registro DESC limit 1");
	    $consulta->execute();
	    $id = $consulta->fetchColumn(0);
	    return $id;
	}

	public function TraerInformeDB($fechas)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("select patente,lugares.id_lugar as lugar,lugares.piso,hora_entrada as entrada,hora_salida as salida,importe from
	        registro_final inner join operaciones on 
	        registro_final.id_operacion=operaciones.id_operacion
	        inner join lugares on lugares.id_lugar=operaciones.id_lugar
	        inner join automovil on automovil.id_automovil=operaciones.id_automovil
	        where hora_entrada BETWEEN :fecha1 AND :fecha2");
	    $consulta->bindParam(":fecha1",$fechas['desde']);
	    $consulta->bindParam(":fecha2",$fechas['hasta']);
	    $consulta->execute();
	    $informe = $consulta->fetchall(PDO::FETCH_ASSOC);
	    return $informe;
	}
	
}