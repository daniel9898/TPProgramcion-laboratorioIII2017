<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	
    <?php require_once"../partes/dependencias.php"; ?>

</head>
<body>
	<?php
	require_once('../partes/barraMenu.php');
	require_once('../clases/consultasSql.php');

	$ArrayDeVehiculos = Automovil::TraerRegistros(); 
	
	echo "<br><br><br><table class='table table-hover table-responsive'>
			<thead>
				<tr>
					<th>  Patente   </th>				
					<th>  Color     </th>
					<th>  Marca   </th>
					<th>  ELIMINAR  </th>
					<th>  MODIFICAR  </th>
				</tr> 
			</thead>";   	

		foreach ($ArrayDeVehiculos as $automovil){

			echo " 	<tr>
						<td>".$automovil->GetPatente()."</td>
						<td>".$automovil->GetColor()."</td>
						<td>".$automovil->GetMarca()."</td>
						<td><button class='btn btn-warning' name='eliminar' 
						onclick='confirmarEliminacion(".$automovil->GetId().")'><span class='glyphicon glyphicon-remove'>&nbsp;</span>Eliminar</button></td>
						<td><button class='btn btn-warning' name='Modificar' 
						onclick='mostrarElDato(".$automovil->GetId().")'><span class='glyphicon glyphicon-edit'>&nbsp;</span>Modificar</button></td>
					</tr>";
		}	
	echo "</table>";		
?>
</body>
</html>




