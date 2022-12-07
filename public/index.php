<?php

require_once '../vendor/autoload.php';

use Dotenv\Dotenv;
use App\Router;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\ViewVariables\UserViewVariables;

session_start();

$dotenv = Dotenv::createImmutable(__DIR__,'../.env');
$dotenv->load();

$router = new Router();
$router->handleUri();