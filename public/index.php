<?php

require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Controllers/PokemonController.php';
require_once __DIR__ . '/../app/Services/PokemonService.php';

use App\Core\Router;
use App\Controllers\PokemonController;

header('Content-Type: application/json');

$router = new Router();

$router->get('/pokemon/{id}', function ($id) {
    $controller = new PokemonController();
    return $controller->show($id);
});


$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
