"use strict";
/// <reference path="jquery/index.d.ts" />
/// <reference path="claseEstacionamiento.ts"/>
/// <reference path="claseCliente.ts"/>
/// <reference path="claseVehiculo.ts"/>
/// <reference path="claseOperacion.ts"/>
/// <reference path="claseRegistro.ts"/>
var Main;
(function (Main) {
    var estacionamiento = new Estacionamiento();
    function Insertar() {
        estacionamiento.ObtenerlugarVacio(estacionamiento.ProcesarLugarVacio);
    }
    Main.Insertar = Insertar;
})(Main || (Main = {}));
var Listado;
(function (Listado) {
    var operacion = new Operacion();
    function SacarVehiculo(idRegistro, idOperacion, idLugar) {
        operacion.CerrarOperacion(idRegistro, idOperacion, idLugar, operacion.procesarCerrarOperacion);
    }
    Listado.SacarVehiculo = SacarVehiculo;
})(Listado || (Listado = {}));
var ListaClientes;
(function (ListaClientes) {
    var cliente = new Cliente();
    function MostrarVehiculos(idCliente) {
        cliente.TraerVehiculos(idCliente, cliente.procesarListaVehiculos);
    }
    ListaClientes.MostrarVehiculos = MostrarVehiculos;
    function EstacionarAutoYaRegistrado(idCliente, idAuto) {
        localStorage.setItem("idCliente", idCliente);
        localStorage.setItem("idAuto", idAuto);
        var estacionamiento = new Estacionamiento();
        estacionamiento.ObtenerlugarVacio(estacionamiento.ProcesarLugarVacioAutoYaRegistrado);
    }
    ListaClientes.EstacionarAutoYaRegistrado = EstacionarAutoYaRegistrado;
})(ListaClientes || (ListaClientes = {}));
//# sourceMappingURL=Modulos.js.map