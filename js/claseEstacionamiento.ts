/// <reference path="jquery/index.d.ts" />
/// <reference path="claseCliente.ts" />

class Estacionamiento
{
	//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
	private urlApi :String = 'http://localHost:8080/tp-master/api-rest/';
	
	constructor() {};

	public ObtenerlugarVacio(callback):any
	{
	   let esDiscap = this.VerificarSiEsLugarParaDiscapacitados();
	   jQuery.get(this.urlApi +'estacionamiento/'+ esDiscap ,callback);
	}

	public VerificarSiEsLugarParaDiscapacitados():string
	{
	  let eslugarParaDiscap = "no";
	  if($("#discap").is(':checked'))
	     eslugarParaDiscap = "si";

	  return eslugarParaDiscap;
	}
    
    public ProcesarLugarVacio(resp):any
	{ 
		if(resp.idLugar != null)
		{
		  let cliente : Cliente = new Cliente();
		  cliente.InsertarCliente(resp,cliente.ProcesarGuardarCliente);
		}
		/*else
			poner mensage en el div informe*/
	}

	public LiberarLugar(idLugar,callback)
	{
	    jQuery.post(this.urlApi +'estacionamiento/'+idLugar,callback);
	}

	public procesarLiberarLugar(resp)
	{
		if(resp.idLugar != null)
		{
			let idRegistro = localStorage.getItem("idRegistro");
			let registro : Registro = new Registro();
			registro.Cerrar(idRegistro,registro.procesarCerrarRegistro);
		}
	}

}