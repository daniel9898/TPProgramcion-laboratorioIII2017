/// <reference path="jquery/index.d.ts" />
/// <reference path="claseVehiculo.ts" />

class Cliente
{
	//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
	private urlApi :String = 'http://localHost:8080/tp-master/api-rest/';

	constructor() {};

    public InsertarCliente(respEstacionam)
    {
      localStorage.setItem("idLugar",respEstacionam.idLugar);
      jQuery.post(this.urlApi +'clientes',this.TomarDatosCliente(),this.procesar);
    }

    private TomarDatosCliente():any
    {
  		  let datos ={
  			"nombre": $("#nombre").val(),
  			"apellido": $("#apellido").val(),
  			"dni": $("#dni").val()
		    };
		  return datos;
    }

    private procesar(resp):any 
    {
      if(resp.respuesta)
      {
      	let vehiculo : Vehiculo = new Vehiculo();
        vehiculo.InsertarVehiculo(resp);
      }
      else
         $("#informe2").html("No hay lugares disponibles.");
    }

    public TraerVehiculos(idCliente)
    {
       $(".n").html("");
       jQuery.get(this.urlApi +'traerVehiculos/'+ idCliente,this.MostrarListaVehiculos);
    }

    private MostrarListaVehiculos(resp):any 
    {
      if(resp.respuesta)
      {
          var cantidad = resp.respuesta.length;
          for(var i=0; i<cantidad; i++)
          {
            $("#filas").before(
                "<tr class='n'>"+
                    "<td>&nbsp;&nbsp;"+resp.respuesta[i].color+"</td>"+
                    "<td>&nbsp;&nbsp;"+resp.respuesta[i].marca+"</td>"+
                    "<td>&nbsp;&nbsp;"+resp.respuesta[i].patente+"</td>"+
                    "<td>&nbsp;&nbsp;<button class='btn btn-sm btn-success' onclick=''>Estacionar</button></td>"+    
                "</tr>");
          }
      }

    }

}