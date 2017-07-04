"use strict";
/// <reference path="jquery/index.d.ts" />
/// <reference path="claseVehiculo.ts" />
var Cliente = (function () {
    function Cliente() {
        //var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
        this.urlApi = 'http://localHost:8080/tp-master/api-rest/';
    }
    ;
    Cliente.prototype.InsertarCliente = function (respEstacionam, callback) {
        localStorage.setItem("idLugar", respEstacionam.idLugar);
        jQuery.post(this.urlApi + 'clientes', this.TomarDatosCliente(), callback);
    };
    Cliente.prototype.TomarDatosCliente = function () {
        var datos = {
            "nombre": $("#nombre").val(),
            "apellido": $("#apellido").val(),
            "dni": $("#dni").val()
        };
        return datos;
    };
    Cliente.prototype.ProcesarGuardarCliente = function (resp) {
        if (resp.respuesta) {
            localStorage.setItem("idCliente", resp.idCliente);
            var vehiculo = new Vehiculo();
            vehiculo.InsertarVehiculo(resp.idCliente, vehiculo.procesarGuardarVehiculo);
        }
        else
            $("#informe2").html("No hay lugares disponibles.");
    };
    Cliente.prototype.TraerVehiculos = function (idCliente, callback) {
        $(".n").html("");
        jQuery.get(this.urlApi + 'traerVehiculos/' + idCliente, callback);
    };
    Cliente.prototype.procesarListaVehiculos = function (resp) {
        if (resp.respuesta) {
            var cantidad = resp.respuesta.length;
            for (var i = 0; i < cantidad; i++) {
                $("#filas").before("<tr class='n'>" +
                    "<td>&nbsp;&nbsp;" + resp.respuesta[i].color + "</td>" +
                    "<td>&nbsp;&nbsp;" + resp.respuesta[i].marca + "</td>" +
                    "<td>&nbsp;&nbsp;" + resp.respuesta[i].patente + "</td>" +
                    "<td>&nbsp;&nbsp;<button class='btn btn-sm btn-success' onclick='ListaClientes.EstacionarAutoYaRegistrado(" + resp.respuesta[i].id_automovil + ")'>Estacionar</button></td>" +
                    "</tr>");
            }
        }
    };
    return Cliente;
}());
//# sourceMappingURL=claseCliente.js.map