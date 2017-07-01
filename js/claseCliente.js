"use strict";
/// <reference path="jquery/index.d.ts" />
/// <reference path="claseVehiculo.ts" />
var Cliente = (function () {
    function Cliente() {
        //var urlApi = 'http://danielpereira.000webhostapp.com/api-rest/';
        this.urlApi = 'http://localHost:8080/tp-master/api-rest/';
    }
    ;
    Cliente.prototype.InsertarCliente = function (respEstacionam) {
        localStorage.setItem("idLugar", respEstacionam.idLugar);
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
    Cliente.prototype.procesar = function (resp) {
        if (resp.respuesta) {
            var vehiculo = new Vehiculo();
            vehiculo.InsertarVehiculo(resp);
        }
        else
            $("#informe2").html("No hay lugares disponibles.");
    };
    Cliente.prototype.TraerVehiculos = function (idCliente) {
        $(".n").html("");
        jQuery.get(this.urlApi + 'traerVehiculos/' + idCliente, this.MostrarListaVehiculos);
    };
    Cliente.prototype.MostrarListaVehiculos = function (resp) {
        if (resp.respuesta) {
            var cantidad = resp.respuesta.length;
            for (var i = 0; i < cantidad; i++) {
                $("#filas").before("<tr class='n'>" +
                    "<td>&nbsp;&nbsp;" + resp.respuesta[i].color + "</td>" +
                    "<td>&nbsp;&nbsp;" + resp.respuesta[i].marca + "</td>" +
                    "<td>&nbsp;&nbsp;" + resp.respuesta[i].patente + "</td>" +
                    "<td>&nbsp;&nbsp;<button class='btn btn-sm btn-success' onclick=''>Estacionar</button></td>" +
                    "</tr>");
            }
        }
    };
    return Cliente;
}());
//# sourceMappingURL=claseCliente.js.map