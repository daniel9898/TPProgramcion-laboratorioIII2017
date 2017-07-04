/// <reference path="jquery/index.d.ts" />

class Log
{
    //var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
  private urlApi :String = 'http://localHost:8080/tp-master/api-rest/';

  constructor(){};

    public VerificarUsuario() : void 
    {
         $.post(this.urlApi + "abrirSesion",this.tomarDatoslogin(),this.procesarRespuesta);
    }
    
    private tomarDatoslogin() :any
    {
        var usuario = $("#usuario").val();
        var clave = $("#clave").val();
        
        var datos = {
            "usuario":usuario,
            "clave":clave
        }
        return  datos;
    }

    private procesarRespuesta(retorno :any)
    {
        if (retorno.respuesta)
        {
            localStorage.setItem("idEmpleadoLog", retorno.idEmpleado);

            if (retorno.idEmpleado == 3)
                window.location.replace("vistas/administrador.php"); 
            else
              window.location.replace("vistas/formularioAlta.php");
        }
        else
            $("#informe").html("Usuario o contraseña incorrecta.");
    }


    public DeslogearUsuario()
    {
        let idEmp = localStorage.getItem("idEmpleadoLog");
        $.post(this.urlApi + "cerrarSesion/" + idEmp, procesarRespuesta);

        function procesarRespuesta(retorno)
        {
            if(retorno.respuesta)
                window.location.replace("../index.html");
        }
    }
}

