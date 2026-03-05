<?php

declare(strict_types=1);

/**
 * Front Controller.
 *
 * Punto de entrada unico de la aplicacion.
 * Define rutas y delega la peticion al Dispatcher.
 */

require_once __DIR__ . '/../app/bootstrap.php';

use App\Controllers\ContactoController;
use App\Controllers\IndexController;
use App\Core\Dispatcher;
use App\Core\Router;

$router = new Router();

// Definicion de rutas.
$router->get('/', [IndexController::class, 'indexAction']);
$router->get('/contactos', [ContactoController::class, 'indexAction']);
$router->get('/contactos/ver/{id}', [ContactoController::class, 'showAction']);
$router->get('/contactos/crear', [ContactoController::class, 'createAction']);
$router->post('/contactos/crear', [ContactoController::class, 'storeAction']);
$router->get('/contactos/editar/{id}', [ContactoController::class, 'editAction']);
$router->post('/contactos/editar/{id}', [ContactoController::class, 'updateAction']);
$router->post('/contactos/borrar/{id}', [ContactoController::class, 'deleteAction']);

// Proceso de despacho.
$route = $router->match($_SERVER['REQUEST_METHOD'] ?? 'GET', $_SERVER['REQUEST_URI'] ?? '/');

$dispatcher = new Dispatcher();
$dispatcher->dispatch($route);
