<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Listado Registros</title>
	
    <?php require_once"../partes/dependencias.php"; ?>

</head>
<body>
	<?php
	require_once('../partes/barraMenu.php');
	require_once("../clases/AccesoDatos.php");
	require_once("../clases/registroFinal.php");

	$registros = RegistroFinal::TraerRegistrosActivos();
	//print_r($registros);
    echo "<h2><center>Estacionados :</center></h2>";
	echo "<br><table class='table table-hover table-responsive'>
			<thead>
				<tr>
					<th>  Apellido   </th>				
					<th>  Patente     </th>
					<th>  Fecha De Ingreso  </th>
					<th>  Lugar     </th>
				</tr> 
			</thead>";   	

		for($i=0; $i<count($registros); $i++){

			echo " 	<tr>
						<td>".$registros[$i][0]."</td>
						<td>".$registros[$i][1]."</td>
						<td>".$registros[$i][2]."</td>
						<td>".$registros[$i][5]."</td>
						<td><button class='btn btn-success' data-toggle='modal' data-target='#myModal' 
						onclick='Listado.SacarVehiculo(".$registros[$i][3].",".$registros[$i][4].",".$registros[$i][5].")'><span class='glyphicon glyphicon-usd'>&nbsp;</span>Facturar</button></td>
					</tr>";
		}	
	echo "</table>";

	require "../partes/Modalimporte.php";			
?>

</body>
</html>




