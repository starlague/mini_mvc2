<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';

use Mini\Core\Router;

// Table des routes minimaliste
$routes = [ //pour avoir accès à une view tjrs en GET et utiliser POST avec une autre méthode pour envoyer les données à la BDD
    ['GET', '/', [Mini\Controllers\HomeController::class, 'index']],//route vers l'accueil

    //pages liées aux utilisateurs
    ['GET', '/signin', [Mini\Controllers\UserController::class, 'signin']], 
    ['POST', '/signin', [Mini\Controllers\UserController::class, 'createUser']], 
    ['GET', '/login', [Mini\Controllers\UserController::class, 'login']],
    ['POST', '/login', [Mini\Controllers\UserController::class,'userExisting']],
    ['GET', '/logout', [Mini\Controllers\UserController::class,'logout']],

    //pages liées aux produits
    ['GET', '/details', [Mini\Controllers\ProduitController::class, 'productDetails']],

    //pages liées au panier
    ['GET', '/panier', [Mini\Controllers\PanierController::class,'panier']],
    ['GET', '/panier/add', [Mini\Controllers\PanierController::class,'addToCart']],
    ['GET', '/panier/decrease', [Mini\Controllers\PanierController::class,'decrease']],
    ['GET', '/panier/delete', [Mini\Controllers\PanierController::class,'delete']],

    //pages liées aux commandes
    ['GET', '/commande/checkout', [Mini\Controllers\CommandeController::class, 'checkout']],
    ['POST', '/commande/validate', [Mini\Controllers\CommandeController::class, 'validate']],
    ['GET', '/commande/success', [Mini\Controllers\CommandeController::class, 'success']],
    ['GET', '/commande/history', [Mini\Controllers\CommandeController::class, 'history']],
    ['GET', '/commande/details', [Mini\Controllers\CommandeController::class, 'details']],
];

// Bootstrap du router
$router = new Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);


