/// <reference path="jquery/index.d.ts" />
/// <reference path="claseOperacion.ts"/>

class Vehiculo
{
	//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
	private urlApi : String = 'http://localHost:8080/tp-master/api-rest/';
	
	constructor() {};

	public InsertarVehiculo(respCallback)
	{
        localStorage.setItem("horaAlta",respCallback.fecha);
		localStorage.setItem("idCliente",respCallback.idCliente);
        let datos = this.TomarDatosVehiculo(respCallback.idCliente);

        jQuery.post(this.urlApi +'vehiculos',datos,this.procesarRespuesta);
	}

	private TomarDatosVehiculo(idCliente):any
    {
	    let datos ={

	    "patente": $("#patente").val(),
	    "color": $("#color").val(),
	    "marca": $("#marca").val(),
	    "idCliente":idCliente
	    };
	    return datos;
    }

    private procesarRespuesta(respCallback):any 
    {
        if(respCallback.respuesta)
        {
        	let operacion : Operacion = new Operacion();
	        operacion.InsertarOperacion(respCallback);
        }
    }


}