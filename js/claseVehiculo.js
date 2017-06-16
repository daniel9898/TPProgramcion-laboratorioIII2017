"use strict";
/// <reference path="jquery/index.d.ts" />
/// <reference path="claseOperacion.ts"/>
var Vehiculo = (function () {
    function Vehiculo() {
        //var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
        this.urlApi = 'http://localHost:8080/tp-master/api-rest/';
    }
    ;
    Vehiculo.prototype.InsertarVehiculo = function (respCallback) {
        localStorage.setItem("horaAlta", respCallback.fecha);
        localStorage.setItem("idCliente", respCallback.idCliente);
        var datos = this.TomarDatosVehiculo(respCallback.idCliente);
        jQuery.post(this.urlApi + 'vehiculos', datos, this.procesarRespuesta);
    };
    Vehiculo.prototype.TomarDatosVehiculo = function (idCliente) {
        var datos = {
            "patente": $("#patente").val(),
            "color": $("#color").val(),
            "marca": $("#marca").val(),
            "idCliente": idCliente
        };
        return datos;
    };
    Vehiculo.prototype.procesarRespuesta = function (respCallback) {
        if (respCallback.respuesta) {
            var operacion = new Operacion();
            operacion.InsertarOperacion(respCallback);
        }
    };
    return Vehiculo;
}());
//# sourceMappingURL=claseVehiculo.js.map