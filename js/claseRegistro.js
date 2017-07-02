"use strict";
/// <reference path="jquery/index.d.ts" />
var Registro = (function () {
    function Registro() {
        //var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
        this.urlApi = 'http://localHost:8080/tp-master/api-rest/';
    }
    Registro.prototype.InsertarRegistro = function (idOperacion, callback) {
        var datos = {
            "idCliente": localStorage.getItem("idCliente"),
            "idOperacion": idOperacion,
            "horaAlta": localStorage.getItem("horaAlta")
        };
        jQuery.post(this.urlApi + 'abrirRegistro', datos, callback);
    };
    Registro.prototype.procesarInsertarRegistro = function (resp) {
        if (resp.respuesta)
            $("#informe2").html("Registro Exitoso.");
        else
            $("#informe2").html("Error,No se pudo guardar el registro.");
    };
    Registro.prototype.Cerrar = function (idRegistro, callback) {
        var dato = { "horaAlta": localStorage.getItem("horaAlta") };
        jQuery.post(this.urlApi + 'cerrarRegistro/' + idRegistro, dato, callback);
    };
    Registro.prototype.procesarCerrarRegistro = function (resp) {
        if (resp.respuesta) {
            $("#importe").html("");
            $("#importe").html("$ " + resp.importe);
            $("#myModal").modal();
            //window.location.replace("listaRegistros.php");
        }
    };
    return Registro;
}());
//# sourceMappingURL=claseRegistro.js.map