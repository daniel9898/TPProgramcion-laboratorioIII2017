<?php  

class Cochera
{
	public $id_lugar;
	public $cantidad;

	public function GetIdLugar()
	{
		return $this->id_lugar;
	}
	public function GetCantidadOperaciones()
	{
		return $this->cantidad;
	}
	public function SetIdLugar($valor)
	{
		$this->id_lugar = $valor;
	}
	public function SetCantidadOperaciones($valor)
	{
		$this->cantidad = $valor;
	}

	public function TraerCocherasUtilizadas($fechas)
	{
      	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta("select operaciones.id_lugar as lugar,count(t.id_operacion) as cantidad from
	        (select id_operacion from registro_final where hora_entrada BETWEEN
	        :fecha1 AND :fecha2)t inner join operaciones on t.id_operacion=operaciones.id_operacion
	        GROUP BY id_lugar HAVING count(id_lugar) ORDER BY count(id_lugar) 
	        DESC");
	    $consulta->bindParam(":fecha1",$fechas['desde']);
	    $consulta->bindParam(":fecha2",$fechas['hasta']);	    
	    $consulta->execute();
	    $datos = $consulta->fetchall(PDO::FETCH_ASSOC);
	    return $datos;
    }

    public function TraerPisoPorId($id)
    {
       	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta("Select piso from lugares where id_lugar = :id");
	    $consulta->bindParam(":id",$id);
	    $consulta->execute();
	    $piso = $consulta->fetchColumn(0);  
	    return $piso;
    }

    public function TraerPisosYcocheras()
    {
       	$objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta("Select id_lugar as lugar,piso from lugares");
	    $consulta->execute();
	    $lugares = $consulta->fetchall(PDO::FETCH_ASSOC);  
	    return $lugares;
    }
}