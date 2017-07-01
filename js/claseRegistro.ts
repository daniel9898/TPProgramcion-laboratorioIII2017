/// <reference path="jquery/index.d.ts" />

class Registro
{
	//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
	private urlApi : String = 'http://localHost:8080/tp-master/api-rest/';

	public InsertarRegistro(respOperacion)
	{
		let datos ={   
	    "idCliente": localStorage.getItem("idCliente"),
	    "idOperacion": respOperacion.idOperacion,
	    "horaAlta": localStorage.getItem("horaAlta")
		};
		
	    jQuery.post(this.urlApi +'abrirRegistro',datos,this.procesarRespuesta);
	}
	
	private procesarRespuesta(resp)
    {
        if(resp.respuesta)
           $("#informe2").html("Registro Exitoso."); 
        else 
          $("#informe2").html("Error,No se pudo guardar el registro.");
    }

    public Cerrar(idRegistro)
	{
	    let dato = {"horaAlta":localStorage.getItem("horaAlta")};

	    jQuery.post(this.urlApi +'cerrarRegistro/'+ idRegistro,dato,this.procesar);
	}

	private procesar(resp)
	{
   	   if(resp.respuesta)
   	   { 
   	   	  $("#importe").html("");
   	   	  $("#importe").html("$ "+resp.importe);
          $("#myModal").modal();
          //window.location.replace("listaRegistros.php");
   	   }      
	}

}