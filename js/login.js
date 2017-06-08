function tomarDatoslogin()
{
    var usuario = $("#usuario").val();
    var clave = $("#clave").val();

    datos = {
        "usuario": usuario,
        "contraseña": clave
    };
    return datos;
}

var urlApi = 'http://localHost:8080/tp-master/api-rest/';

function verificarUsuario()
{    
    $.post(urlApi + "abrirSesion", tomarDatoslogin(), procesarRespuesta);

    function procesarRespuesta(retorno) {
    
         if(retorno.respuesta)
         {
            localStorage.setItem("idEmpleadoLog",retorno.idEmpleado);

            if(retorno.idEmpleado == 3)
               window.location.replace("logica-administrador/administrador.html");
            else
               window.location.replace("logica-empleados/empleado.php");
         }  
         else
            $("#informe").html("Usuario o contraseña incorrecta.");
    }

}

function DeslogearUsuario()
{
    var idEmp = localStorage.getItem("idEmpleadoLog");
    $.post(urlApi + "cerrarSesion/" + idEmp, procesarRespuesta);

    function procesarRespuesta(retorno)
    {
        if(retorno.respuesta)
            window.location.replace("../index.html");
    }
}