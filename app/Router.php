<?php

namespace App;

use App\Controllers\NewsController;
use App\Controllers\RegisterController;
use App\Controllers\LoginController;
use App\Controllers\ProfileController;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;

class Router
{
    private Dispatcher $dispatcher;

    public function __construct()
    {
        $this->dispatcher = simpleDispatcher(function (RouteCollector $route) {
            $route->addRoute('GET', '/', [NewsController::class, 'index']);
            $route->addRoute('GET', '/register', [RegisterController::class, 'showForm']);
            $route->addRoute('POST', '/register', [RegisterController::class, 'register']);
            $route->addRoute('GET', '/login', [LoginController::class, 'showForm']);
            $route->addRoute('POST', '/login', [LoginController::class, 'login']);
            $route->addRoute('GET', '/profile', [ProfileController::class, 'showForm']);
            $route->addRoute('POST', '/profile=changeName', [ProfileController::class, 'changeName']);
            $route->addRoute('POST', '/profile=changeEmail', [ProfileController::class, 'changeEmail']);
            $route->addRoute('POST', '/profile=changePassword', [ProfileController::class, 'changePassword']);
            $route->addRoute('POST', '/profile=deleteAccount', [ProfileController::class, 'deleteAccount']);
        });
    }

    public function handleUri(): void
    {
        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];

                [$controller, $method] = $handler;

                $response = (new $controller)->{$method}();

                if ($response instanceof Template) {
                    echo $response->render();
                }
                break;
        }
    }
}