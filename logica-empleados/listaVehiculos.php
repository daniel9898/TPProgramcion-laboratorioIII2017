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
	require_once("../clases/AccesoDatos.php");
	require_once("../clases/registroFinal.php");

	$vehiculos = RegistroFinal::TraerRegistrosActivos(); 
	//LA TABLA DE REGISTRO_FINAL TIENE TODOS ESTOS DATOS
	echo "<br><br><br><table class='table table-hover table-responsive'>
			<thead>
				<tr>
					<th>  Apellido   </th>				
					<th>  Patente     </th>
					<th>  Hora De Ingreso  </th>
					<th>  FACTURACIÓN  </th>
				</tr> 
			</thead>";   	

		foreach ($vehiculos as $automovil){

			echo " 	<tr>
						<td>".$automovil->GetPatente()."</td>
						<td>".$automovil->GetColor()."</td>
						<td>".$automovil->GetMarca()."</td>
						<td><button class='btn btn-warning' name='eliminar' 
						onclick='confirmarEliminacion(".$automovil->GetId().")'><span class='glyphicon glyphicon-usd'>&nbsp;</span>Sacar y Cobrar</button></td>
					</tr>";
		}	
	echo "</table>";		
?>
</body>
</html>




