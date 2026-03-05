<?php

declare(strict_types=1);

/**
 * Dispatcher que ejecuta el controlador y accion resueltos por el Router.
 */

namespace App\Core;

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
            return $this->handleError("El controlador '{$controllerName}' no existe.");
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $actionName)) {
            return $this->handleError("La accion '{$actionName}' no existe en el controlador.");
        }

        return call_user_func_array([$controller, $actionName], $params);
    }

    private function handleNotFound(): void
    {
        http_response_code(404);

        if (class_exists('App\\Controllers\\BaseController')) {
            $errorManager = new \App\Controllers\BaseController();
            $errorManager->mostrarError('Lo sentimos, la pagina que buscas no existe.', 404);
            return;
        }

        echo '404 - Ruta no encontrada';
    }

    private function handleError(string $mensaje): void
    {
        http_response_code(500);

        if (class_exists('App\\Controllers\\BaseController') && defined('VIEWS_DIR')) {
            $errorManager = new \App\Controllers\BaseController();
            $errorManager->renderHTML(VIEWS_DIR . '/errors/general_error.php', ['mensaje' => $mensaje]);
            return;
        }

        echo '500 - ' . $mensaje;
    }
}
