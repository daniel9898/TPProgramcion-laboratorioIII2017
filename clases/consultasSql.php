<?php

require_once("AccesoDatos.php");
require_once("automovil.php");

function TraerRegistros()
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
    
    $consulta = $objetoAcceso->RetornarConsulta("SELECT * from automovil");
    $consulta->execute();
    $datos = $consulta->setFetchMode(PDO::FETCH_INTO,new Automovil);
    return $consulta;
   
}

function InsertarRegistro($patente, $color,$marca)
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso();
    $consulta = $objetoAcceso->RetornarConsulta("insert into automovil (patente,color,marca) values(:patente,:color,:marca)");
    $consulta->bindParam(":patente",$patente);
    $consulta->bindParam(":color",$color);
    $consulta->bindParam(":marca",$marca);
    return $consulta->execute();
}

function EliminarRegistro($id)
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
    $consulta = $objetoAcceso->RetornarConsulta("delete from automovil where id_automovil = :id");
    $consulta->bindParam(":id",$id);
    return $consulta->execute();
}

function ComprobarSiExisteRegistro($id)
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
    $consulta = $objetoAcceso->RetornarConsulta("select count(id_automovil) from automovil where id_automovil = :id");
    $consulta->bindParam(":id",$id);
    $consulta->execute();
    $res = $consulta->fetchColumn(0);
    if($res)
        return true;
    else
        return false;
}

function TraerRegistro($id) 
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
    $consulta = $objetoAcceso->RetornarConsulta('select * from automovil where id_automovil = '.$id.'');   
    $consulta->execute();
    $autoBuscado = $consulta->fetchObject('Automovil');
    return $autoBuscado;    
}

function ModificarRegistro($patente,$color,$marca,$id)
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
    $consulta = $objetoAcceso->RetornarConsulta("
                update automovil
                set patente=:patente,
                color=:color,
                marca=:marca
                WHERE id_automovil=:id");
    $consulta->bindParam(":patente",$patente);
    $consulta->bindParam(":color",$color);
    $consulta->bindParam(":marca",$marca);
    $consulta->bindParam(":id",$id);
    return $consulta->execute();
}

/*function ModificarRegistro($campoAmodificar,$valor,$id)
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
    $consulta = $objetoAcceso->RetornarConsulta('update automovil set '.$campoAmodificar.' = :valor where id_automovil = :id');
    $consulta->bindParam(":valor",$valor);
    $consulta->bindParam(":id",$id);
    return $consulta->execute();
}*/

?>