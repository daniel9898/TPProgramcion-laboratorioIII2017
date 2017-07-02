/// <reference path="claselog.ts"/>

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