<?php

error_reporting(-1);
ini_set('display_errors', 1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/accesoADatos/Archivos.php';
require __DIR__ . '/accesoADatos/AccesoDatos.php';
require __DIR__ . '/controllers/usuariosController.php';
require __DIR__ . '/entidades/Usuarios.php';
require __DIR__ . '/entidades/Articulos.php';
require __DIR__ . '/controllers/ArticulosController.php';



// Instantiate App
$app = AppFactory::create();
// Add error middleware
$app->addErrorMiddleware(true, true, true);
//header('Access-Control-Allow-Origin:*');
// Enable CORS
$app->add(function (Request $request, RequestHandlerInterface $handler): Response {
    // $routeContext = RouteContext::fromRequest($request);
    // $routingResults = $routeContext->getRoutingResults();
    // $methods = $routingResults->getAllowedMethods();
    
    $response = $handler->handle($request);

    $requestHeaders = $request->getHeaderLine('Access-Control-Request-Headers');

    $response = $response->withHeader('Access-Control-Allow-Origin', '*');
    $response = $response->withHeader('Access-Control-Allow-Methods', 'get,post');
    $response = $response->withHeader('Access-Control-Allow-Headers', $requestHeaders);

    // Optional: Allow Ajax CORS requests with Authorization header
    // $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');

    return $response;
});

//$app->get('[/]', \usuariosController::class . ':Listar' );
//$app->get('/Usuarios[/]', \usuariosController::class . ':Listar' );
$app->group('/Usuarios', function (RouteCollectorProxy $group) {
    $group->get('/Login/{nombreUsuario}/{pass}[/]', \usuariosController::class . ':Login' );
    $group->post('/Alta', \usuariosController::class . ':Alta' );
    $group->post('/Baja', \usuariosController::class . ':Baja' );
    $group->post('/Modificacion', \usuariosController::class . ':Modificacion' );
    $group->get('/Listar', \usuariosController::class . ':Listar' );
    $group->POST('/Listar', \usuariosController::class . ':Listar' );
});



$app->group('/Articulo', function (RouteCollectorProxy $group) {
    $group->post('/Alta', \ArticulosController::class . ':Alta' );
    $group->post('/Baja', \ArticulosController::class . ':Baja' );
    $group->post('/Modificacion', \ArticulosController::class . ':Modificacion' );
    $group->POST('/Listar', \ArticulosController::class . ':Listar' );
});

$app->run();