/// <reference path="jquery/index.d.ts" />

class Registro
{
	//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
	private urlApi : String = 'http://localHost:8080/tp-master/api-rest/';

	public InsertarRegistro(respCallback)
	{
		let datos ={   
	    "idCliente": localStorage.getItem("idCliente"),
	    "idOperacion": respCallback.idOperacion,
	    "horaAlta": localStorage.getItem("horaAlta")
		};
		
	    jQuery.post(this.urlApi +'abrirRegistro',datos,this.procesarRespuesta);
	}
	
	private procesarRespuesta(respCallback)
    {
        if(respCallback.respuesta)
           $("#informe2").html("Registro Exitoso."); 
        else 
          $("#informe2").html("Error,No se pudo guardar el registro.");
    }

    public Cerrar(idRegistro)
	{
	    let dato = {"horaAlta":localStorage.getItem("horaAlta")};

	    jQuery.post(this.urlApi +'cerrarRegistro/'+ idRegistro,dato,this.procesar);
	}

	private procesar(respCallback)
	{
   	   if(respCallback.respuesta)
           alert("IMPORTE A PAGAR : $"+respCallback.importe);
	}

}