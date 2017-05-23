<?php
require_once"../clases/consultas.php";

$patente = $_POST['patente'];
$color = $_POST['color'];
$marca = $_POST['marca'];

if(isset($patente) && isset($color) && isset($marca))
	 echo InsertarRegistro($patente,$color,$marca);
	
?>
