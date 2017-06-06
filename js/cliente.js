function TomarDatosCliente()
{
	datos ={

		"nombre": $("#nombre").val(),
		"apellido": $("#apellido").val(),
		"dni": $("#dni").val()
	};
	return datos;
}

var urlApi = 'http://localHost:8080/tp-master/api-rest/';
//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';

function InsertarCliente()
{
  var resp = VerificarSiEsLugarParaDiscapacitados();
  var hayLugar = ObtenerlugarVacio(resp);
}

function VerificarSiEsLugarParaDiscapacitados()
{
  var eslugarParaDiscap = "no";
  if($("#discap").is(':checked'))
     eslugarParaDiscap = "si";

  return eslugarParaDiscap;
}

function ObtenerlugarVacio(esDiscap)
{
   jQuery.get(urlApi +'estacionamiento/'+ esDiscap ,procesarRespuesta);

    function procesarRespuesta(res)
    {
        var obj1 = ObtenerRespuestaEnFormatoJson(res);
        //console.log(obj1.idLugar);
          if(obj1.idLugar != false)//devuelve false o el id del lugar
            {
              jQuery.post(urlApi +'clientes',TomarDatosCliente(),procesar);

                function procesar(res)
                {
                    var obj2 = ObtenerRespuestaEnFormatoJson(res);
                    //console.log(obj2); 
 
                    if(obj2.respuesta)
                    {
                        localStorage.setItem("horaAlta",obj2.fecha);
                        var ok = InsertarVehiculo(obj2.idCliente,obj1.idLugar); 
                    }
                }
            }
            else
            $("#informe2").html("No hay lugares disponibles.");  
    }
}

function ObtenerRespuestaEnFormatoJson(resp)
{
	var lista = resp == null ? [] : (resp instanceof Array ? resp : [resp]);

  lista2 = lista[0].split('{');
  var respJson = '{'+lista2[1];

  var obj = JSON.parse(respJson);
  return obj;	
}

function CrearOperacion(idCliente,idEmpEnt,idLugar)//idcliente y automovil es el mismo
{
  datos = {
    'idCliente':idCliente,
    'idAutomovil':idCliente,
    'idLugar':idLugar,
    'idEmpleadoAlta':idEmpEnt
  };
  //console.log(datos);

  jQuery.post(urlApi +'altaOperacion',datos,procesarRespuesta);

      function procesarRespuesta(res)
      {
          var obj = ObtenerRespuestaEnFormatoJson(res); 
          if(obj.respuesta)
          {
            var horaAlta = localStorage.getItem("horaAlta");
            GrabarRegistroFinal(idCliente,obj.idOperacion,horaAlta);
          }
      
      }
}


function GrabarRegistroFinal(idCliente,idOperacion,horaAlta)
{
  datos = {
    "idCliente": idCliente,
    "idOperacion": idOperacion,
    "horaAlta": horaAlta
  }
  //console.log(datos);
	jQuery.post(urlApi +'abrirRegistro',datos,procesarRespuesta);

      function procesarRespuesta(res)
      {
          var obj = ObtenerRespuestaEnFormatoJson(res); 
          if(obj.respuesta)
            $("#informe2").html("Registro Exitoso."); 
          else 
            $("#informe2").html("Error,No se pudo guardar el registro."); 
      }
}