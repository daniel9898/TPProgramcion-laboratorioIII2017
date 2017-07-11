<?php

class Empleado 
{

    public $id_empleado;
    public $nombre;
    public $apellido;
    public $usuario;
    public $contraseña;
    public $id_cargo;
    public $Esta_logeado;
    public $estado;

    public function GetId()
	{
		return $this->id_empleado;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetApellido()
	{
		return $this->apellido;
	}
	public function GetUsuario()
	{
		return $this->usuario;
	}
	public function GetContraseña()
	{
		return $this->contraseña;
	}
	public function GetIdCargo()
	{
		return $this->id_cargo;
	}
		public function EstaLogeado()
	{
		return $this->Esta_logeado;
	}
	public function GetEstado()
	{
		return $this->estado;
	}

	public function SetId($valor)
	{
		$this->id_empleado = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetApellido($valor)
	{
		$this->apellido = $valor;
	}
	public function SetUsuario($valor)
	{
		$this->usuario = $valor;
	}
	public function SetClave($valor)
	{
		$this->contraseña = $valor;
	}
	public function SetIdCargo($valor)
	{
		$this->id_cargo = $valor;
	}
	public function SetEstaLogeado($valor)
	{
		$this->Esta_logeado = $valor;
	}

	public function SetEstado($valor)
	{
		$this->estado = $valor;
	}


	public function Traer($id) 
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta('select * from empleados where id_empleado='.$id.'');   
	    $consulta->execute();
	    $empBuscado = $consulta->fetchObject('Empleado');
	    return $empBuscado;    
	}

	public function TraerTodosDB()
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("SELECT * from empleados");
	    $consulta->execute();
	    $datos = $consulta->setFetchMode(PDO::FETCH_INTO,new Empleado);
	    return $consulta;
	}

    public function Insertar($nombre,$apellido,$usuario,$contraseña,$cargo)
	{
		$id_cargo = 2; // cajero
		if($cargo == "administrador")
	       $id_cargo = 1;

	    $Esta_logeado = "no";
	    $estado = "activo";

	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
	    $consulta = $objetoAcceso->RetornarConsulta("insert into empleados
	     (nombre,apellido,usuario,contraseña,id_cargo,Esta_logeado,estado) values(:v1,:v2,:v3,:v4,:v5,:v6,:v7)");
	    $consulta->bindParam(":v1",$nombre);
	    $consulta->bindParam(":v2",$apellido);
	    $consulta->bindParam(":v3",$usuario);
	    $consulta->bindParam(":v4",$contraseña);
	    $consulta->bindParam(":v5",$id_cargo);
	    $consulta->bindParam(":v6",$Esta_logeado);
	    $consulta->bindParam(":v7",$estado);
	    
	    return $consulta->execute();
	}

	public static function TraerUltimoIdAgregado()
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("select id_empleado from empleados order by id_empleado DESC limit 1");
	    $consulta->execute();
	    $id = $consulta->fetchColumn(0);
	    return $id;
	}

	public function Despedir($id)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta("delete from empleados where id_empleado = :id");
	    $consulta->bindParam(":id",$id);
	    return $consulta->execute();
	}

	public function ComprobarSiExiste($id)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta("select count(id_empleado) from empleados where id_empleado = :id");
	    $consulta->bindParam(":id",$id);
	    $consulta->execute();
	    $res = $consulta->fetchColumn(0);
	    if($res)
	        return true;
	    else
	        return false;
	}

	public function GuardarEmpleadosdespedidos($idEmp,$motivo,$nombre,$apellido)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta('insert into empleados_despedidos
	     (id_empleado,motivo,nombre,apellido) values(:v1,:v2,:v3,:v4)');
	    $consulta->bindParam(":v1",$idEmp);
	    $consulta->bindParam(":v2",$motivo);
	    $consulta->bindParam(":v3",$nombre);
	    $consulta->bindParam(":v4",$apellido);
	    return $consulta->execute();
	}

	public function Suspender($idEmp)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta("update empleados set estado='suspendido' WHERE id_empleado=:id");
	    $consulta->bindParam(":id",$idEmp);
	    return $consulta->execute();
	}

	public function GuardarEmpleadosSuspendidos($idEmp,$motivo,$nombre,$apellido,$cantDias)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    $consulta = $objetoAcceso->RetornarConsulta('insert into empleados_suspendidos
	     (id_empleado,nombre,apellido,motivo,cant_dias) values(:v1,:v2,:v3,:v4,:v5)');
	    $consulta->bindParam(":v1",$idEmp);
	    $consulta->bindParam(":v2",$nombre);
	    $consulta->bindParam(":v3",$apellido);
	    $consulta->bindParam(":v4",$motivo);
	    $consulta->bindParam(":v5",$cantDias);
	    return $consulta->execute();
	}

	public static function ModificarRestriccionDeClaveForanea($flag)
	{
	    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
	    
	    $consulta = $objetoAcceso->RetornarConsulta("SET foreign_key_checks = ".$flag."");
	    return $consulta->execute();
	}

}