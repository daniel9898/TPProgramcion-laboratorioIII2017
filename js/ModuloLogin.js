"use strict";
/// <reference path="claselog.ts"/>
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
//# sourceMappingURL=ModuloLogin.js.map