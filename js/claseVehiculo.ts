/// <reference path="jquery/index.d.ts" />
/// <reference path="claseOperacion.ts"/>

class Vehiculo
{
	//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
	private urlApi : String = 'http://localHost:8080/tp-master/api-rest/';
	
	constructor() {};

	public InsertarVehiculo(idCliente,callback)
	{
        let datos = this.TomarDatosVehiculo(idCliente);

        jQuery.post(this.urlApi +'vehiculos',datos,callback);
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

    public procesarGuardarVehiculo(resp):any 
    {
        if(resp.respuesta)
        {
        	let operacion : Operacion = new Operacion();
	        operacion.InsertarOperacion(operacion.ProcesarInsertarOperacion);
        }
    }


}