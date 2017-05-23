<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../estilos/style.css">

</head>
<body>
	<?php
	require_once('../partes/barraMenu.php');
	require_once('../clases/consultas.php');

	$ArrayDeVehiculos = traerRegistros();
	
	echo "<br><br><br><table class='table table-hover table-responsive'>
			<thead>
				<tr>
					<th>  Patente   </th>				
					<th>  Color     </th>
					<th>  Marca   </th>
					<th>  MODIFICAR  </th>
				</tr> 
			</thead>";   	

		foreach ($ArrayDeVehiculos as $automovil){

			echo " 	<tr>
						<td>".$automovil->GetPatente()."</td>
						<td>".$automovil->GetColor()."</td>
						<td>".$automovil->GetMarca()."</td>
					
						<td><button class='btn btn-warning' name='Modificar' onclick='Modificar(".$automovil->GetPatente().")'><span class='glyphicon glyphicon-edit'>&nbsp;</span>Modificar</button></td>
					</tr>";
		}	
	echo "</table>";		
?>
</body>
</html>




