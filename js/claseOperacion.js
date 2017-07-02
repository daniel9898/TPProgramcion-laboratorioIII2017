"use strict";
/// <reference path="jquery/index.d.ts" />
/// <reference path="claseRegistro.ts"/>
/// <reference path="claseEstacionamiento.ts"/>
var Operacion = (function () {
    function Operacion() {
        //var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
        this.urlApi = 'http://localHost:8080/tp-master/api-rest/';
    }
    ;
    Operacion.prototype.InsertarOperacion = function (callback) {
        var datos = {
            'idCliente': localStorage.getItem("idCliente"),
            'idAutomovil': localStorage.getItem("idCliente"),
            'idLugar': localStorage.getItem("idLugar"),
            'idEmpleadoAlta': localStorage.getItem("idEmpleadoLog")
        };
        jQuery.post(this.urlApi + 'altaOperacion', datos, callback);
    };
    Operacion.prototype.ProcesarInsertarOperacion = function (resp) {
        if (resp.respuesta) {
            alert("entro");
            var registro = new Registro();
            registro.InsertarRegistro(resp.idOperacion, registro.procesarInsertarRegistro);
        }
        /*else
           informar en el div*/
    };
    Operacion.prototype.CerrarOperacion = function (idRegistro, idOperacion, idLugar, callback) {
        localStorage.setItem("idRegistro", idRegistro);
        localStorage.setItem("idlugar", idLugar);
        var dato = { "idEmpleadoSalida": localStorage.getItem("idEmpleadoLog") };
        jQuery.post(this.urlApi + 'bajaOperacion/' + idOperacion, dato, callback);
    };
    Operacion.prototype.procesarCerrarOperacion = function (resp) {
        if (resp.respuesta) {
            var idLugar = localStorage.getItem("idlugar");
            var estacionamiento = new Estacionamiento();
            estacionamiento.LiberarLugar(idLugar, estacionamiento.procesarLiberarLugar);
        }
        /*else
           informar en el div*/
    };
    return Operacion;
}());
//# sourceMappingURL=claseOperacion.js.map