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
    Operacion.prototype.InsertarOperacion = function (respVehiculo) {
        var datos = {
            'idCliente': localStorage.getItem("idCliente"),
            'idAutomovil': localStorage.getItem("idCliente"),
            'idLugar': localStorage.getItem("idLugar"),
            'idEmpleadoAlta': localStorage.getItem("idEmpleadoLog")
        };
        jQuery.post(this.urlApi + 'altaOperacion', datos, this.procesarRespuesta);
    };
    Operacion.prototype.procesarRespuesta = function (resp) {
        if (resp.respuesta) {
            var registro = new Registro();
            registro.InsertarRegistro(resp);
        }
        /*else
         informar en el div*/
    };
    Operacion.prototype.CerrarOperacion = function (idRegistro, idOperacion, idLugar) {
        localStorage.setItem("idRegistro", idRegistro);
        localStorage.setItem("idlugar", idLugar);
        var dato = { "idEmpleadoSalida": localStorage.getItem("idEmpleadoLog") };
        jQuery.post(this.urlApi + 'bajaOperacion/' + idOperacion, dato, this.procesar);
    };
    Operacion.prototype.procesar = function (resp) {
        if (resp.respuesta) {
            var idLugar = localStorage.getItem("idlugar");
            var estacionamiento = new Estacionamiento();
            estacionamiento.LiberarLugar(idLugar);
        }
        /*else
        informar en el div*/
    };
    return Operacion;
}());
//# sourceMappingURL=claseOperacion.js.map