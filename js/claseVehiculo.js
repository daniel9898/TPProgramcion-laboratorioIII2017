"use strict";
/// <reference path="jquery/index.d.ts" />
/// <reference path="claseOperacion.ts"/>
var Vehiculo = (function () {
    function Vehiculo() {
        //var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
        this.urlApi = 'http://localHost:8080/tp-master/api-rest/';
    }
    ;
    Vehiculo.prototype.InsertarVehiculo = function (idCliente, callback) {
        var datos = this.TomarDatosVehiculo(idCliente);
        jQuery.post(this.urlApi + 'vehiculos', datos, callback);
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
    Vehiculo.prototype.procesarGuardarVehiculo = function (resp) {
        if (resp.respuesta) {
            localStorage.setItem("idAuto", resp.idAuto);
            var operacion = new Operacion();
            operacion.InsertarOperacion(operacion.ProcesarInsertarOperacion);
        }
    };
    return Vehiculo;
}());
//# sourceMappingURL=claseVehiculo.js.map