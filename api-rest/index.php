<?php 

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require "vendor/autoload.php";
require_once '../clases/AutentificadorJWT.php';
require_once '../clases/MWparaCORS.php';
require_once '../clases/MWparaAutentificar.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$app = new \Slim\App(["settings" => $config]);

date_default_timezone_set('America/Argentina/Buenos_Aires');

require_once "../clases/AccesoDatos.php";

require "../clases/apiOperaciones.php";
require "../clases/apiEmpleados.php";
require "../clases/apiCochera.php";
require "../clases/apiRegistroFinal.php";
require "../clases/apiAutomovil.php";
require "../clases/apiCliente.php";
require "../clases/apiEstacionamiento.php";
require "../clases/apiSesion.php";
require "../clases/apiArchivo.php";

//ENTIDAD SESION
$app->group('/sesion', function () {
  
  $this->get('/', \ApiSesion::class . ':TraerSesiones')->add(\MWparaCORS::class . 
    ':HabilitarCORSTodos');

  $this->post('/abrir', \ApiSesion::class . ':AbrirSesion');

  $this->put('/cerrar', \ApiSesion::class . ':CerrarSesion');
  
})->add(\MWparaCORS::class . ':HabilitarURLtp');

//ENTIDAD ESTACIONAMIENTO
$app->group('/estacionamiento', function () {

  $this->get('/{esDiscap}', \ApiEstacionamiento::class . ':TraerLugarVacio')->add(\MWparaCORS::class . 
    ':HabilitarCORSTodos');

  $this->put('/{idLugar}', \ApiEstacionamiento::class . ':LiberarLugar');
  
})->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarURLtp');

//ENTIDAD CLIENTE
$app->group('/clientes', function () {

  $this->get('/{id}', \ApiCliente::class . ':TraerVehiculos')->add(\MWparaCORS::class . 
    ':HabilitarCORSTodos');

  $this->post('/', \ApiCliente::class . ':CargarUno');
  
})->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarURLtp');

//ENTIDAD AUTOMOVIL
$app->group('/automovil', function () {
 
  $this->get('/', \ApiAutomovil::class . ':traerTodos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');

  $this->get('/{id}', \ApiAutomovil::class . ':traerUno')->add(\MWparaCORS::class . 
    ':HabilitarCORSTodos');

  $this->post('/', \ApiAutomovil::class . ':CargarUno');

  $this->delete('/{id}', \ApiAutomovil::class . ':BorrarUno');

  $this->put('/{id}', \ApiAutomovil::class . ':ModificarUno');
   
})->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarURLtp');


//ENTIDAD OPERACION
$app->group('/operaciones', function () {

  $this->get('/porEmpleado', \ApiOperacion::class . ':traerUno')->add(\MWparaCORS::class . 
  	':HabilitarCORSTodos');

  $this->post('/', \ApiOperacion::class . ':CargarUno');

  $this->delete('/', \ApiOperacion::class . ':BorrarUno');
   
})->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarURLtp');

//ENTIDAD REGISTRO FINAL
$app->group('/registroFinal', function () {

  $this->get('/', \ApiRegistroFinal::class . ':TraerInforme')->add(\MWparaCORS::class . ':HabilitarCORSTodos');

  $this->post('/abrir', \ApiRegistroFinal::class . ':AbrirRegistro');

  $this->post('/cerrar/{id}', \ApiRegistroFinal::class . ':CerrarRegistro');

})->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarURLtp');

//ENTIDAD EMPLEADO
$app->group('/empleados', function () {
 
  $this->get('/', \ApiEmpleado::class . ':traerTodos')->add(\MWparaCORS::class . ':HabilitarCORSTodos');

  $this->get('/{id}', \ApiEmpleado::class . ':traerUno')->add(\MWparaCORS::class . 
  	':HabilitarCORSTodos');

  $this->post('/', \ApiEmpleado::class . ':CargarUno');

  $this->delete('/despedir', \ApiEmpleado::class . ':BorrarUno');

  $this->put('/suspender', \ApiEmpleado::class . ':ModificarUno');
   
})->add(\MWparaAutentificar::class . ':VerificarUsuario')->add(\MWparaCORS::class . ':HabilitarURLtp');

//ENTIDAD COCHERA
$app->group('/cocheras', function () {
 
  $this->get('/masUsada', \ApiCochera::class . ':TraerMasUtilizada');

  $this->get('/menosUsada', \ApiCochera::class . ':TraerMenosUtilizada');

  $this->get('/sinUso', \ApiCochera::class . ':TraerCocherasSinUso');
 
})->add(\MWparaCORS::class . ':HabilitarCORSTodos');

//ARCHIVOS
$app->group('/archivos', function () {

  $this->get('/{id}', \ApiArchivo::class . ':TraerArchivo');

  $this->post('/', \ApiArchivo::class . ':GuardarArchivoEnServidor');
  
});


$app->run();
?>
