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
        {
          let lugar = localStorage.getItem("idLugar");
          $("#informeAlta").html("<h3>Operación Exitosa ! estacionar en el lugar : "+lugar+"</h3>");
          $("#ModalAlta").modal();
          this.LimpiarFormulario(); //NO FUNCIONA
        }
        else
        {
    	  $("#informeAlta").html("<h3>Error,No se pudo guardar el registro.</h3>");
    	  $("#ModalAlta").modal();
        } 
          
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
   	   }      
	}

	private LimpiarFormulario():void 
	{
		$("#nombre").val("");
		$("#apellido").val("");
		$("#dni").val("");
		$("#patente").val("");
		$("#color").val("");
		$("#marca").val("");
	}

}