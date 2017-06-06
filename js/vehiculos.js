function TomarDatosVehiculo(id)
{
	datos ={

		"patente": $("#patente").val(),
		"color": $("#color").val(),
		"marca": $("#marca").val(),
		"idCliente":id
	};
	return datos;
}

var urlApi = 'http://localHost:8080/tp-master/api-rest/';
//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';

function InsertarVehiculo(idCliente,idLugar)
{
	var resp = false;
	var datos = TomarDatosVehiculo(idCliente);
	var idEmpLogeado = localStorage.getItem("idEmpleadoLog");
    //console.log(datos);
	jQuery.post(urlApi +'vehiculos',datos,procesarRespuesta);

	function procesarRespuesta(res)
	{
	  var obj = ObtenerRespuestaEnFormatoJson(res);
	  if(obj)
	     var operacion = CrearOperacion(idCliente,idEmpLogeado,idLugar);  
    }
    
}



