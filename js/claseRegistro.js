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
        if (resp.respuesta) {
            var lugar = localStorage.getItem("idLugar");
            $("#informeAlta").html("<h3>Operación Exitosa ! estacionar en el lugar : " + lugar + "</h3>");
            $("#ModalAlta").modal();
            this.LimpiarFormulario(); //NO FUNCIONA
        }
        else {
            $("#informeAlta").html("<h3>Error,No se pudo guardar el registro.</h3>");
            $("#ModalAlta").modal();
        }
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
        }
    };
    Registro.prototype.LimpiarFormulario = function () {
        $("#nombre").val("");
        $("#apellido").val("");
        $("#dni").val("");
        $("#patente").val("");
        $("#color").val("");
        $("#marca").val("");
    };
    return Registro;
}());
//# sourceMappingURL=claseRegistro.js.map