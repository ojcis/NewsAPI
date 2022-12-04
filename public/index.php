<?php

require_once '../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Router;
use App\Template;
use App\Controllers\NewsController;
use App\Controllers\RegisterController;
use App\Controllers\LoginController;

session_start();

$dotenv = Dotenv::createImmutable(__DIR__,'../.env');
$dotenv->load();

$router = new Router();
$router->handleUri();

/**
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {
    $route->addRoute('GET', '/', [NewsController::class, 'index']);
    $route->addRoute('GET', '/register', [RegisterController::class, 'showForm']);
    $route->addRoute('POST', '/register', [RegisterController::class, 'register']);
    $route->addRoute('GET', '/login', [LoginController::class, 'showForm']);
    $route->addRoute('POST', '/login', [LoginController::class, 'login']);
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        [$controller, $method] = $handler;

        $response = (new $controller)->{$method}();

        if ($response instanceof Template) {
            echo $response->render();
        }
        break;
}
*/