"use strict";
/// <reference path="jquery/index.d.ts" />
/// <reference path="claseCliente.ts" />
var Estacionamiento = (function () {
    function Estacionamiento() {
        //var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
        this.urlApi = 'http://localHost:8080/tp-master/api-rest/';
    }
    ;
    Estacionamiento.prototype.ObtenerlugarVacio = function () {
        var esDiscap = this.VerificarSiEsLugarParaDiscapacitados();
        jQuery.get(this.urlApi + 'estacionamiento/' + esDiscap, this.procesarRespuesta);
    };
    Estacionamiento.prototype.VerificarSiEsLugarParaDiscapacitados = function () {
        var eslugarParaDiscap = "no";
        if ($("#discap").is(':checked'))
            eslugarParaDiscap = "si";
        return eslugarParaDiscap;
    };
    Estacionamiento.prototype.procesarRespuesta = function (resp) {
        if (resp.idLugar != null) {
            var cliente = new Cliente();
            cliente.InsertarCliente(resp);
        }
        /*else
            poner mensage en el div informe*/
    };
    Estacionamiento.prototype.LiberarLugar = function (idLugar) {
        jQuery.post(this.urlApi + 'estacionamiento/' + idLugar, this.procesar);
    };
    Estacionamiento.prototype.procesar = function (resp) {
        if (resp.idLugar != null) {
            var idRegistro = localStorage.getItem("idRegistro");
            var registro = new Registro();
            registro.Cerrar(idRegistro);
        }
    };
    Estacionamiento.prototype.EstacionarAutoYaRegistrado = function () {
    };
    return Estacionamiento;
}());
//# sourceMappingURL=claseEstacionamiento.js.map