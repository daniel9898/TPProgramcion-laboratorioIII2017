<?php 

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require "vendor/autoload.php";
$settings = require "configs.php";
$app = new \Slim\App($settings);

date_default_timezone_set('America/Argentina/Buenos_Aires');

require_once "../clases/AccesoDatos.php";

require "../clases/cliente.php";
require "../clases/automovil.php";
require "../clases/operacion.php";
require "../clases/Sesion.php";
require "../clases/registroFinal.php";
require "../clases/estacionamiento.php";

require "rutasVehiculo.php";
require "rutasCliente.php";
require "rutasOperaciones.php";
require "rutasSesion.php";
require "rutasRegistros.php";
require "rutasEstacionamiento.php";

$app->run();
?>
