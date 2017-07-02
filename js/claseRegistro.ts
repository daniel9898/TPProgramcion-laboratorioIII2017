/// <reference path="jquery/index.d.ts" />

class Registro
{
	//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
	private urlApi : String = 'http://localHost:8080/tp-master/api-rest/';

	public InsertarRegistro(idOperacion,callback)
	{
		let datos ={   
	    "idCliente": localStorage.getItem("idCliente"),
	    "idOperacion": idOperacion,
	    "horaAlta": localStorage.getItem("horaAlta")
		};
		
	    jQuery.post(this.urlApi +'abrirRegistro',datos,callback);
	}
	
	public procesarInsertarRegistro(resp)
    {
        if(resp.respuesta)
           $("#informe2").html("Registro Exitoso."); 
        else 
          $("#informe2").html("Error,No se pudo guardar el registro.");
    }

    public Cerrar(idRegistro,callback)
	{
	    let dato = {"horaAlta":localStorage.getItem("horaAlta")};

	    jQuery.post(this.urlApi +'cerrarRegistro/'+ idRegistro,dato,callback);
	}

	public procesarCerrarRegistro(resp)
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