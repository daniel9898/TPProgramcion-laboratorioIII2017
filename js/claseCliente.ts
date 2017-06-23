/// <reference path="jquery/index.d.ts" />
/// <reference path="claseVehiculo.ts" />

class Cliente
{
	//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
	private urlApi :String = 'http://localHost:8080/tp-master/api-rest/';

	constructor() {};

    public InsertarCliente(respCallback)
    {
      localStorage.setItem("idLugar",respCallback.idLugar);
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

    private procesar(respCallback):any 
    {
      if(respCallback.respuesta)
      {
      	let vehiculo : Vehiculo = new Vehiculo();
        vehiculo.InsertarVehiculo(respCallback);
      }
      else
         $("#informe2").html("No hay lugares disponibles.");
    }

    public TraerVehiculos(idCliente)
    {
       $(".n").html("");
       jQuery.get(this.urlApi +'traerVehiculos/'+ idCliente,this.MostrarVehic);
    }

    private MostrarVehic(respCallback):any 
    {
      if(respCallback.respuesta)
      {
          var cantidad = respCallback.respuesta.length;
          for(var i=0; i<cantidad; i++)
          {
            $("#filas").before(
                "<tr class='n'>"+
                    "<td>&nbsp;&nbsp;"+respCallback.respuesta[i].color+"</td>"+
                    "<td>&nbsp;&nbsp;"+respCallback.respuesta[i].marca+"</td>"+
                    "<td>&nbsp;&nbsp;"+respCallback.respuesta[i].patente+"</td>"+
                    "<td><a class='btn btn-sm btn-success btn-block'>Estacionar</a></td>"+    
                "</tr>");
          }
      }

    }

}