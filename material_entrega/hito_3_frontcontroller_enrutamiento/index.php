<?php
/*****************************************************
 * TAREA 1
 * 
 * Incluye bloque de documentación del archivo. 
 * 
 * FIN TAREA
*/
require_once __DIR__ . '/../app/bootstrap.php';

/*****************************************************
 * TAREA 2
 * 
 * Incluye el uso de las clases necesarias. 
 * 
 * FIN TAREA
*/
$router = new Routez();

// --- Definición de Rutas ---
$router->get('/', [IndexController::class, 'indexAction']);
$router->get('/contactos', [ContactoController::class, 'indexAction']);
$router->get('/contactos/ver/{id}', [ContactoController::class, 'showAction']);
$router->get('/contactos/crear', [ContactoController::class, 'createAction']);
$router->post('/contactos/crear', [ContactoController::class, 'storeAction']);
/*****************************************************
 * TAREA 3
 * 
 * Incluye las rutas necesarias para la edición y el borrado. 
 * 
 * FIN TAREA
*/


// --- Proceso de Despacho ---
$route = $router->match($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

$dispatcher = new Dispatcher();
$dispatcher->dispatch($route);