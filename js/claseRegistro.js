"use strict";
/// <reference path="jquery/index.d.ts" />
var Registro = (function () {
    function Registro() {
        //var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
        this.urlApi = 'http://localHost:8080/tp-master/api-rest/';
    }
    Registro.prototype.InsertarRegistro = function (respCallback) {
        var datos = {
            "idCliente": localStorage.getItem("idCliente"),
            "idOperacion": respCallback.idOperacion,
            "horaAlta": localStorage.getItem("horaAlta")
        };
        jQuery.post(this.urlApi + 'abrirRegistro', datos, this.procesarRespuesta);
    };
    Registro.prototype.procesarRespuesta = function (respCallback) {
        if (respCallback.respuesta)
            $("#informe2").html("Registro Exitoso.");
        else
            $("#informe2").html("Error,No se pudo guardar el registro.");
    };
    Registro.prototype.Cerrar = function (idRegistro) {
        var dato = { "horaAlta": localStorage.getItem("horaAlta") };
        jQuery.post(this.urlApi + 'cerrarRegistro/' + idRegistro, dato, this.procesar);
    };
    Registro.prototype.procesar = function (respCallback) {
        if (respCallback.respuesta)
            alert("IMPORTE A PAGAR : $" + respCallback.importe);
    };
    return Registro;
}());
//# sourceMappingURL=claseRegistro.js.map