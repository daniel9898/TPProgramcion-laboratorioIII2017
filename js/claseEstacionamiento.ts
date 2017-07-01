/// <reference path="jquery/index.d.ts" />
/// <reference path="claseCliente.ts" />

class Estacionamiento
{
	//var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
	private urlApi :String = 'http://localHost:8080/tp-master/api-rest/';
	
	constructor() {};

	public ObtenerlugarVacio():any
	{
	   let esDiscap = this.VerificarSiEsLugarParaDiscapacitados();
	   jQuery.get(this.urlApi +'estacionamiento/'+ esDiscap ,this.procesarRespuesta);
	}

	public VerificarSiEsLugarParaDiscapacitados():string
	{
	  let eslugarParaDiscap = "no";
	  if($("#discap").is(':checked'))
	     eslugarParaDiscap = "si";

	  return eslugarParaDiscap;
	}
    
    private procesarRespuesta(resp):any
	{ 
		if(resp.idLugar != null)
		{
		  let cliente : Cliente = new Cliente();
		  cliente.InsertarCliente(resp);
		}
		/*else
			poner mensage en el div informe*/
	}

	public LiberarLugar(idLugar)
	{
	    jQuery.post(this.urlApi +'estacionamiento/'+idLugar,this.procesar);
	}

	private procesar(resp)
	{
		if(resp.idLugar != null)
		{
			let idRegistro = localStorage.getItem("idRegistro");
			let registro : Registro = new Registro();
			registro.Cerrar(idRegistro);
		}
	}

	public EstacionarAutoYaRegistrado()
	{

	}
}