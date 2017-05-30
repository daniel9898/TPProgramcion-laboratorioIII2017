function validarVehiculo()
{
	datos ={

		"patente": $("#patente").val(),
		"color": $("#color").val(),
		"marca": $("#marca").val()
	};
	return datos;
}

function InsertarVehiculo()
{
	var datos = validarVehiculo();

	jQuery.post('http://localHost:8080/tp-master/api-rest/vehiculos',datos,procesarRespuesta);

	function procesarRespuesta(respuesta)
	{
		console.log(respuesta);
      if (respuesta)
      	  $("#informe2").html("Se a registrado correctamente.");
      else
          $("#informe2").html("error,no se pudo registrar");
	}
	
}

function Eliminar(id)
{
	console.log(id);
    $.ajax({
   	url: 'http://localHost:8080/tp-master/api-rest/vehiculos/'+id,
   	type: 'DELETE',
   })
   .done(function(data) {
   	console.log(data);
   	window.location.replace("../logica-empleados/listaVehiculos.php");
   })
   .fail(function() {
   	console.log("error");
   });

}

function confirmarEliminacion(id)
{
	swal({
	  title:'Estas seguro?',
	  text: "Este proceso no se podra revertir!!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'si, borrar!'
	}).then(function (data) {

	  swal(
	    'Borrado!',
	    'A eliminado un registro!',
	    'success',
	  ),

	  Eliminar(id)
	});
}

function mostrarElDato(id)
{
	localStorage.setItem('idAmodificar',id);
    window.location.replace("../logica-empleados/modificarAuto.php?id="+id);
}


function Modificar()
{
  var id = localStorage.getItem('idAmodificar');

  $.ajax({
  	url: 'http://localHost:8080/tp-master/api-rest/vehiculos/'+id,
  	type: 'PUT',
  	data : validarVehiculo()
  })
  .done(function(data) {
  	window.location.replace("../logica-empleados/listaVehiculos.php");
  	console.log(data);
  })
  .fail(function() {
  	console.log("error");
  });
 
}



