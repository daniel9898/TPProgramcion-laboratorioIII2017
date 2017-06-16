"use strict";
/// <reference path="claselog.ts"/>
/// <reference path="claseEstacionamiento.ts"/>
/// <reference path="claseOperacion.ts"/>
var LOG;
(function (LOG) {
    var log = new Log();
    function entrar() {
        log.VerificarUsuario();
    }
    LOG.entrar = entrar;
    function salir() {
        log.DeslogearUsuario();
    }
    LOG.salir = salir;
})(LOG || (LOG = {}));
var Main;
(function (Main) {
    var estacionamiento = new Estacionamiento();
    function Insertar() {
        estacionamiento.ObtenerlugarVacio();
    }
    Main.Insertar = Insertar;
})(Main || (Main = {}));
var Listado;
(function (Listado) {
    var operacion = new Operacion();
    function SacarVehiculo(idRegistro, idOperacion, idLugar) {
        operacion.CerrarOperacion(idRegistro, idOperacion, idLugar);
    }
    Listado.SacarVehiculo = SacarVehiculo;
})(Listado || (Listado = {}));
//# sourceMappingURL=Modulos.js.map