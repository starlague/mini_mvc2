<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Mini\Core\Router;

// Table des routes minimaliste
$routes = [ //pour avoir accès à une view tjrs en GET et utiliser POST avec une autre méthode pour envoyer les données à la BDD
    ['GET', '/', [Mini\Controllers\HomeController::class, 'index']],//route vers l'accueil
    ['GET', '/users', [Mini\Controllers\HomeController::class, 'users']], //route vers la liste de tous les users
    ['GET', '/signin', [Mini\Controllers\HomeController::class, 'signin']], 
    ['POST', '/signin', [Mini\Controllers\HomeController::class, 'createUser']], 
    ['GET', '/login', [Mini\Controllers\HomeController::class, 'login']],
    ['POST', '/login', [Mini\Controllers\HomeController::class,'userExisting']],

    //pages liées aux produits
    ['GET', '/produits', [Mini\Controllers\HomeController::class, 'produits']],
    ['GET', '/details', [Mini\Controllers\HomeController::class, 'detailsProduit']],
];

// Bootstrap du router
$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);


