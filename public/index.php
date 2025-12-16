<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Mini\Core\Router;

// Table des routes minimaliste
$routes = [
    ['GET', '/', [Mini\Controllers\HomeController::class, 'index']],
    ['GET', '/users', [Mini\Controllers\HomeController::class, 'users']],
    ['GET', '/signin', [Mini\Controllers\HomeController::class, 'signin']], //pour avoir accès à une view tjrs en GET
    ['GET', '/login', [Mini\Controllers\HomeController::class, 'login']],
    ['GET', '/produits', [Mini\Controllers\HomeController::class, 'produits']],
];

// Bootstrap du router
$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);


