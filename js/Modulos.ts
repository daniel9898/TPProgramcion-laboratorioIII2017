/// <reference path="jquery/index.d.ts" />
/// <reference path="claseEstacionamiento.ts"/>
/// <reference path="claseCliente.ts"/>
/// <reference path="claseVehiculo.ts"/>
/// <reference path="claseOperacion.ts"/>
/// <reference path="claseRegistro.ts"/>

module Main // formularioAlta.php
{
   var estacionamiento : Estacionamiento = new Estacionamiento();

   export function Insertar()
   {
      estacionamiento.ObtenerlugarVacio(estacionamiento.ProcesarLugarVacio);
   }
}

module Listado // listaRegistros.php
{
   var operacion : Operacion = new Operacion();

   export function SacarVehiculo(idRegistro,idOperacion,idLugar)
   {
      operacion.CerrarOperacion(idRegistro,idOperacion,idLugar,operacion.procesarCerrarOperacion);
   }
 
}

module ListaClientes // listaClientes.php
{
   var cliente : Cliente = new Cliente();

   export function MostrarVehiculos(idCliente)
   {
      localStorage.setItem("idCliente",idCliente);
      cliente.TraerVehiculos(idCliente,cliente.procesarListaVehiculos);
   }

   export function EstacionarAutoYaRegistrado(idAuto)
   {
      localStorage.setItem("idAuto",idAuto);
      var estacionamiento : Estacionamiento = new Estacionamiento();
      estacionamiento.ObtenerlugarVacio(estacionamiento.ProcesarLugarVacioAutoYaRegistrado); 
   }

   export function EstacionarNuevoAutoDeClienteRegistrado()
   {
      let estacionamiento : Estacionamiento = new Estacionamiento();
      estacionamiento.ObtenerlugarVacio(estacionamiento.ProcesarLugarVacioClienteYaRegistrado); 
   }
}