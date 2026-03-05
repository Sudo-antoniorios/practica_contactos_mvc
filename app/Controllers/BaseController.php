<?php

declare(strict_types=1);

namespace App\Controllers;

class BaseController
{
    public function __construct()
    {
    }

    public function renderHTML(string $fileName, array $data = []): void
    {
        if (!file_exists($fileName)) {
            $this->mostrarError('La vista solicitada no existe: ' . basename($fileName), 500);
            return;
        }

        // Helpers de vista compartidos.
        $helpersPath = VIEWS_DIR . '/helpers/main_helper.php';
        if (file_exists($helpersPath)) {
            require_once $helpersPath;
        }

        // Bufferiza la vista para inyectarla despues en el layout base.
        extract($data, EXTR_SKIP);
        ob_start();
        include $fileName;
        $content = ob_get_clean();

        $titulo_pagina = $data['titulo_pagina'] ?? $data['titulo'] ?? 'Agenda de Contactos';
        $layoutPath = VIEWS_DIR . '/layouts/base_view.php';

        if (file_exists($layoutPath)) {
            include $layoutPath;
        } else {
            echo $content;
        }
    }

    protected function redirect(string $url): void
    {
        $fullUrl = (strpos($url, 'http') === 0) ? $url : BASE_URL . $url;
        header('Location: ' . $fullUrl);
        exit;
    }

    public function mostrarError(string $mensaje, int $codigo = 404): void
    {
        http_response_code($codigo);
        $data = [
            'titulo' => 'Ups! Algo ha ido mal',
            'mensaje' => $mensaje,
            'codigo' => $codigo,
        ];

        include VIEWS_DIR . '/errors/general_error.php';
        exit;
    }

    public function mostrarErrorDB(string $mensaje): void
    {
        http_response_code(500);
        $data = [
            'titulo' => 'Error de Base de Datos',
            'mensaje' => $mensaje,
        ];

        $dbView = VIEWS_DIR . '/errors/db_error.php';
        if (file_exists($dbView)) {
            include $dbView;
            exit;
        }

        $this->mostrarError($mensaje, 500);
    }
}
