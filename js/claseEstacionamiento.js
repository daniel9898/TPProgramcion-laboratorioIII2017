"use strict";
/// <reference path="jquery/index.d.ts" />
/// <reference path="claseCliente.ts" />
var Estacionamiento = (function () {
    function Estacionamiento() {
        //var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
        this.urlApi = 'http://localHost:8080/tp-master/api-rest/';
    }
    ;
    Estacionamiento.prototype.ObtenerlugarVacio = function (callback) {
        var esDiscap = this.VerificarSiEsLugarParaDiscapacitados();
        jQuery.get(this.urlApi + 'estacionamiento/' + esDiscap, callback);
    };
    Estacionamiento.prototype.VerificarSiEsLugarParaDiscapacitados = function () {
        var eslugarParaDiscap = "no";
        if ($("#discap").is(':checked'))
            eslugarParaDiscap = "si";
        return eslugarParaDiscap;
    };
    Estacionamiento.prototype.ProcesarLugarVacio = function (resp) {
        if (resp.idLugar != null) {
            var cliente = new Cliente();
            cliente.InsertarCliente(resp, cliente.ProcesarGuardarCliente);
        }
        /*else
            poner mensage en el div informe*/
    };
    Estacionamiento.prototype.LiberarLugar = function (idLugar, callback) {
        jQuery.post(this.urlApi + 'estacionamiento/' + idLugar, callback);
    };
    Estacionamiento.prototype.procesarLiberarLugar = function (resp) {
        if (resp.idLugar != null) {
            var idRegistro = localStorage.getItem("idRegistro");
            var registro = new Registro();
            registro.Cerrar(idRegistro, registro.procesarCerrarRegistro);
        }
    };
    return Estacionamiento;
}());
//# sourceMappingURL=claseEstacionamiento.js.map