/// <reference path="claselog.ts"/>
/// <reference path="claseEstacionamiento.ts"/>
/// <reference path="claseOperacion.ts"/>

module LOG //index.html
{
   var log : Log = new Log();

   export function entrar():void
   {
       log.VerificarUsuario();
   }

   export function salir():void
   {
       log.DeslogearUsuario();
   }
}

module Main // formularioAlta.php
{
   var estacionamiento : Estacionamiento = new Estacionamiento();

   export function Insertar()
   {
      estacionamiento.ObtenerlugarVacio();
   }
}

module Listado // listaRegistros.php
{
   var operacion : Operacion = new Operacion();

   export function SacarVehiculo(idRegistro,idOperacion,idLugar)
   {
      operacion.CerrarOperacion(idRegistro,idOperacion,idLugar);
   }
}