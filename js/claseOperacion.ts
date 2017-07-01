/// <reference path="jquery/index.d.ts" />
/// <reference path="claseRegistro.ts"/>
/// <reference path="claseEstacionamiento.ts"/>

class Operacion
{
	//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
	private urlApi :String = 'http://localHost:8080/tp-master/api-rest/';
	
	constructor() {};

	public InsertarOperacion(respVehiculo)//por ahora no usa el parametro
	{
		let datos ={   
		 	  'idCliente':localStorage.getItem("idCliente"),
		    'idAutomovil':localStorage.getItem("idCliente"),
		    'idLugar':localStorage.getItem("idLugar"),
		    'idEmpleadoAlta':localStorage.getItem("idEmpleadoLog")
		    };
		
	    jQuery.post(this.urlApi +'altaOperacion',datos,this.procesarRespuesta);
	}

	private procesarRespuesta(resp):any 
    {
       if(resp.respuesta)
       {
       	 let registro : Registro = new Registro();
	       registro.InsertarRegistro(resp);
       }
       /*else
       	informar en el div*/
    }

    public CerrarOperacion(idRegistro,idOperacion,idLugar)
    {
      localStorage.setItem("idRegistro",idRegistro);
      localStorage.setItem("idlugar",idLugar);

	    let dato={ "idEmpleadoSalida": localStorage.getItem("idEmpleadoLog") };
	    jQuery.post(this.urlApi +'bajaOperacion/'+ idOperacion,dato,this.procesar);
    }

    private procesar(resp):any 
    {
    	if(resp.respuesta)
    	{ 
    	  let idLugar = localStorage.getItem("idlugar");
        let estacionamiento : Estacionamiento = new Estacionamiento();
        estacionamiento.LiberarLugar(idLugar);
    	}
    	/*else
       	informar en el div*/
    }

}