<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//require_once __DIR__ . '/../app/Core/Router.php';
//require_once __DIR__ . '/../app/Controllers/PokemonController.php';
//require_once __DIR__ . '/../app/Services/PokemonService.php';
//require_once __DIR__ . '/../app/Models/Pokemon.php';

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\PokemonController;

header('Content-Type: application/json');

$router = new Router();

$router->get('/pokemon/{id}', function ($id) {
    $controller = new PokemonController();
    return $controller->show($id);
});


$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
