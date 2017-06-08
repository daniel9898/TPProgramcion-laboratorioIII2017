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

    function procesarRespuesta(resp)
    {
          if(resp.idLugar != false)//devuelve false o el id del lugar
            {
              jQuery.post(urlApi +'clientes',TomarDatosCliente(),procesar);

                function procesar(resp2)
                {
                    if(resp2.respuesta)
                    {
                        localStorage.setItem("horaAlta",resp2.fecha);
                        var ok = InsertarVehiculo(resp2.idCliente,resp.idLugar); 
                    }
                }
            }
            else
            $("#informe2").html("No hay lugares disponibles.");
    }
}

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

function InsertarVehiculo(idCliente,idLugar)
{
  var resp = false;
  var datos = TomarDatosVehiculo(idCliente);
  var idEmpLogeado = localStorage.getItem("idEmpleadoLog");

  jQuery.post(urlApi +'vehiculos',datos,procesarRespuesta);

    function procesarRespuesta(res)
    {
      if(res)
         var operacion = CrearOperacion(idCliente,idEmpLogeado,idLugar);  
    }
}

function CrearOperacion(idCliente,idEmpEnt,idLugar)//idcliente y automovil es el mismo
{
  datos = {
    'idCliente':idCliente,
    'idAutomovil':idCliente,
    'idLugar':idLugar,
    'idEmpleadoAlta':idEmpEnt
  };

  jQuery.post(urlApi +'altaOperacion',datos,procesarRespuesta);

      function procesarRespuesta(res)
      {
          if(res.respuesta)
          {
            var horaAlta = localStorage.getItem("horaAlta");
            GrabarRegistroFinal(idCliente,res.idOperacion,horaAlta);
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
  
	jQuery.post(urlApi +'abrirRegistro',datos,procesarRespuesta);

      function procesarRespuesta(res)
      {
          if(res.respuesta)
            $("#informe2").html("Registro Exitoso."); 
          else 
            $("#informe2").html("Error,No se pudo guardar el registro.");
      }
}

function Facturar(idRegistro,idOperacion,idLugar)
{
  var idEmpLogeado = localStorage.getItem("idEmpleadoLog");
  dato={ "idEmpleadoSalida": idEmpLogeado };
      
  jQuery.post(urlApi +'bajaOperacion/'+ idOperacion,dato,procesarRespuesta);
  
    function procesarRespuesta(res)
    {
        if(res.respuesta)
        {
           jQuery.post(urlApi +'estacionamiento/'+ idLugar,procesarRespuesta);

           function procesarRespuesta(resp)
           {
             CalcularMonto(idRegistro);
           }
        }
    }
}

function CalcularMonto(idRegistro)
{
    var horaAlta = localStorage.getItem("horaAlta");
    var dato = {"horaAlta":horaAlta};

    console.log(idRegistro);
   // console.log(horaAlta);

    jQuery.post(urlApi +'cerrarRegistro/'+ idRegistro,dato,procesarRespuesta);
    function procesarRespuesta(res)
    {
      //console.log(res);
      if(res.respuesta)
        console.log("IMPORTE A PAGAR : $"+res.importe);

    }
}






