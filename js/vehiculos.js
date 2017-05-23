function validarVehiculo()
{
	datos ={

		"patente": $("#patente").val(),
		"color": $("#color").val(),
		"marca": $("#marca").val()
	};

	jQuery.post('validarVehiculo.php',datos,procesarRespuesta);

	function procesarRespuesta(respuesta)
	{
      if (respuesta == 1)
      	  $("#informe2").html("Se a registrado correctamente.");
      else
          $("#informe2").html("error,no se pudo registrar");
	}
	
}

