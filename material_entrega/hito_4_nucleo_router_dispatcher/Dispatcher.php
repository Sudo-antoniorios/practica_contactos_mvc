<?php
/*****************************************************
 * TAREA 1
 * 
 * Incluye bloque de documentación del archivo. 
 * 
 * FIN TAREA
*/

namespace App\Core;

/*****************************************************
* TAREA 2
* 
* Comenta adecuadamente cada uno de los métodos de la clase.
* 
* FIN TAREA
*/

class Dispatcher 
{

    public function dispatch(?array $route) 
    {
        if (!$route) {
            return $this->handleNotFound();
        }

        [$controllerName, $actionName] = $route['handler'];
        $params = $route['params'] ?? [];


        if (!class_exists($controllerName)) {
            return $this->handleError("El controlador '$controllerName' no existe.");
        }


        $controller = new $controllerName();

        if (!method_exists($controller, $actionName)) {
            return $this->handleError("La acción '$actionName' no existe en el controlador.")
        }

        return call_user_func_array([$controller, $actionName], $params);
    }

    private function handleNotFound() 
    {
        http_response_code(404);
        $errorManager = new \App\Controllers\BaseController();
        $errorManager->mostrarError("Lo sentimos, la página que buscas no existe.", 404);
    }

    private function handleError(string $mensaje) 
    {
        http_code(500);
        $errorManager = new \App\Controllers\BaseController();
        $errorManager->renderHTML(VIEWS_DIR '/errors/general_error.php', ['mensaje' => $mensaje]);
    }
}