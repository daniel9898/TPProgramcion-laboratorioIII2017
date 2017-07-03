/// <reference path="jquery/index.d.ts" />
/// <reference path="claseVehiculo.ts" />

class Cliente
{
	//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
	private urlApi :String = 'http://localHost:8080/tp-master/api-rest/';

	constructor() {};

    public InsertarCliente(respEstacionam,callback)
    {
      localStorage.setItem("idLugar",respEstacionam.idLugar);
      jQuery.post(this.urlApi +'clientes',this.TomarDatosCliente(),callback);
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

    public ProcesarGuardarCliente(resp):any 
    {
      if(resp.respuesta)
      {
        localStorage.setItem("idCliente",resp.idCliente);
        
        let vehiculo : Vehiculo = new Vehiculo();
        vehiculo.InsertarVehiculo(resp.idCliente,vehiculo.procesarGuardarVehiculo);
      }
      else
        $("#informe2").html("No hay lugares disponibles.");
    }

    public TraerVehiculos(idCliente,callback)
    {
       $(".n").html("");
       jQuery.get(this.urlApi +'traerVehiculos/'+ idCliente,callback);
    }

    public procesarListaVehiculos(resp):any 
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
                    "<td>&nbsp;&nbsp;<button class='btn btn-sm btn-success' onclick='ListaClientes.EstacionarAutoYaRegistrado("+resp.respuesta[i].id_automovil+","+resp.respuesta[i].id_cliente+")'>Estacionar</button></td>"+    
                "</tr>");
          }
      }

    }

}