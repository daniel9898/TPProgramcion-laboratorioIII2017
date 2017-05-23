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
    if(!$consulta)
        return false;
    else
    {
        $consulta->execute();
        return true;
    }
}

function EliminarRegistro($codBarra)
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
    $consulta = $objetoAcceso->RetornarConsulta("delete from producto where codigo_barra = :codigo_barra");
    $consulta->bindParam(":codigo_barra",$codBarra);
    if(!$consulta)
        return false;
    else
    {
        $consulta->execute();
        return true;
    }
}

function TraerRegistro($codigo)
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
    $consulta = $objetoAcceso->RetornarConsulta('select codigo_barra as codBarra,nombre,path_foto as pathFoto from producto where codigo_barra = '.$codigo.'');   
    $consulta->execute();
    $ProductoBuscado = $consulta->setFetchMode(PDO::FETCH_INTO,new Producto);
    return $consulta;
}

function ModificarRegistro($campoAmodificar,$valor,$codBarra)
{
    $objetoAcceso = AccesoDatos::DameUnObjetoAcceso(); 
    $consulta = $objetoAcceso->RetornarConsulta('update producto set '.$campoAmodificar.' = :valor where codigo_barra = :codigo_barra');
    $consulta->bindParam(":valor",$valor);
    $consulta->bindParam(":codigo_barra",$codBarra);
    if(!$consulta)
        return false;
    else
    {
        $consulta->execute();
        return true;
    }
}




?>