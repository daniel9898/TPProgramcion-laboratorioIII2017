<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lista Clientes</title>
	
    <?php require_once"../partes/dependencias.php"; ?>

</head>
<body>
	<?php
	require_once('../partes/barraMenu.php');
	require_once("../clases/AccesoDatos.php");
	require_once("../clases/cliente.php");

	$clientes = Cliente::TraerTodos();

	echo "<h3><center>- Clientes :</center></h3>";
	echo "<br><table class='table table-hover table-responsive'>
			<thead>
				<tr>
					<th>  Nombre   </th>				
					<th>  Apellido     </th>
					<th>  Dni  </th>
				</tr> 
			</thead>";   	

		foreach($clientes as $cliente){

			echo " 	<tr>
						<td>".$cliente->GetNombre()."</td>
						<td>".$cliente->GetApellido()."</td>
						<td>".$cliente->GetDni()."</td>
						<td><button class='btn btn-warning' data-toggle='modal'
						data-target='#ModalClientes' 
						onclick='ListaClientes.MostrarVehiculos(".$cliente->GetId().")'><span class='glyphicon glyphicon-share-alt'>&nbsp;</span>Vehiculos</button></td>
					</tr>";
		}	
	echo "</table>";

	require "../partes/ModalCliente.php";		
?>
</body>
</html>
