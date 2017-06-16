"use strict";
/// <reference path="jquery/index.d.ts" />
/// <reference path="claseVehiculo.ts" />
var Cliente = (function () {
    function Cliente() {
        //var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
        this.urlApi = 'http://localHost:8080/tp-master/api-rest/';
    }
    ;
    Cliente.prototype.InsertarCliente = function (respCallback) {
        localStorage.setItem("idLugar", respCallback.idLugar);
        jQuery.post(this.urlApi + 'clientes', this.TomarDatosCliente(), this.procesar);
    };
    Cliente.prototype.TomarDatosCliente = function () {
        var datos = {
            "nombre": $("#nombre").val(),
            "apellido": $("#apellido").val(),
            "dni": $("#dni").val()
        };
        return datos;
    };
    Cliente.prototype.procesar = function (respCallback) {
        if (respCallback.respuesta) {
            var vehiculo = new Vehiculo();
            vehiculo.InsertarVehiculo(respCallback);
        }
        else
            $("#informe2").html("No hay lugares disponibles.");
    };
    return Cliente;
}());
//# sourceMappingURL=claseCliente.js.map