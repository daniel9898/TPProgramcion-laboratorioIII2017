/// <reference path="jquery/index.d.ts" />
/// <reference path="claseRegistro.ts"/>
/// <reference path="claseEstacionamiento.ts"/>

class Operacion
{
	//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
	private urlApi :String = 'http://localHost:8080/tp-master/api-rest/';
	
	constructor() {};

	public InsertarOperacion(callback)
	{
		let datos ={   
		 	  'idCliente':localStorage.getItem("idCliente"),
		    'idAutomovil':localStorage.getItem("idAuto"),
		    'idLugar':localStorage.getItem("idLugar"),
		    'idEmpleadoAlta':localStorage.getItem("idEmpleadoLog")
		    };
		
	    jQuery.post(this.urlApi +'altaOperacion',datos,callback);
	}

	public ProcesarInsertarOperacion(resp):any 
  {
     if(resp.respuesta)
     {
       localStorage.setItem("horaAlta",resp.horaAlta);
     	 let registro : Registro = new Registro();
       registro.InsertarRegistro(resp.idOperacion,registro.procesarInsertarRegistro);
     }
     else
     {
       $("#informeM").html("<h4>El vehiculo que intenta estacionar ya se encuentra en playa lugar : "+resp.lugar+"</h4>");
     }
  }

  public CerrarOperacion(idRegistro,idOperacion,idLugar,callback)
  {
    localStorage.setItem("idRegistro",idRegistro);
    localStorage.setItem("idlugar",idLugar);

    let dato={ "idEmpleadoSalida": localStorage.getItem("idEmpleadoLog") };
    jQuery.post(this.urlApi +'bajaOperacion/'+ idOperacion,dato,callback);
  }

  public procesarCerrarOperacion(resp):any 
  {
    if(resp.respuesta)
    { 
      let idLugar = localStorage.getItem("idlugar");
      let estacionamiento : Estacionamiento = new Estacionamiento();
      estacionamiento.LiberarLugar(idLugar,estacionamiento.procesarLiberarLugar);
    }
    /*else
       informar en el div*/
  }

}