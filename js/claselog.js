"use strict";
/// <reference path="jquery/index.d.ts" />
var Log = (function () {
    function Log() {
        //var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
        this.urlApi = 'http://localHost:8080/tp-master/api-rest/';
    }
    ;
    Log.prototype.VerificarUsuario = function () {
        $.post(this.urlApi + "abrirSesion", this.tomarDatoslogin(), this.procesarRespuesta);
    };
    Log.prototype.tomarDatoslogin = function () {
        var usuario = $("#usuario").val();
        var clave = $("#clave").val();
        var datos = {
            "usuario": usuario,
            "clave": clave
        };
        return datos;
    };
    Log.prototype.procesarRespuesta = function (retorno) {
        if (retorno.respuesta) {
            localStorage.setItem("idEmpleadoLog", retorno.idEmpleado);
            if (retorno.idEmpleado == 3)
                window.location.replace("logica-administrador/administrador.html");
            else
                window.location.replace("logica-empleados/empleado.php");
        }
        else
            $("#informe").html("Usuario o contraseña incorrecta.");
    };
    Log.prototype.DeslogearUsuario = function () {
        var idEmp = localStorage.getItem("idEmpleadoLog");
        $.post(this.urlApi + "cerrarSesion/" + idEmp, procesarRespuesta);
        function procesarRespuesta(retorno) {
            if (retorno.respuesta)
                window.location.replace("../index.html");
        }
    };
    return Log;
}());
//# sourceMappingURL=claselog.js.map