<?php 

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
//namespace App\middleWare; 
require "vendor/autoload.php";
$settings = require "configs.php";
$app = new \Slim\App($settings);

require "../clases/consultasSql.php";
require "rutas.php";

$app->run();
?>
