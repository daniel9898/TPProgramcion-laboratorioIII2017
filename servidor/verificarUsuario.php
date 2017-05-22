<?php
session_start();

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];
//$recordar = $_POST['recordar'];

$resultado;

if($usuario == "admin" && $clave == "admin")
{
    $resultado = "Administrador logeado";
    $_SESSION['usuario'] = $usuario;

}
else if($usuario == "emp1" && $clave == "emp1" || $usuario == "emp2" && $clave == "emp2"
        || $usuario == "emp3" && $clave == "emp3" )
{
	$resultado ="Empleado : logeado.";
}
else
$resultado = "Error al logear.";

echo $resultado;



?>