<?php 
/*****************************************************
 * TAREA 1
 * 
 * Incluye bloque de documentación del archivo. 
 * 
 * FIN TAREA
*/

/*****************************************************
 * TAREA 2
 * 
 * Documenta cada una de los métodos de la clase. 
 * 
 * FIN TAREA
*/


namespace App\Controllers;


class BaseController {

    public function __construct() {
       
    }
    
 
    public function renderHTML($fileName, $data = []) {

        if (!file_exists($fileName)) {
            $this->mostrarError("La vista solicitada no existe: " . basename($fileName), 500);
            return;
        }
        

        $helpersPath = VIEWS_DIR . '/helpers/main_helper.php';
        if (file_exists($helpersPath)) {
            require_once $helpersPath;
        }

        
        /*****************************************************
         * TAREA 3
         * 
         * Comenta las siguientes líneas de código justificando la necesidad de utilizar ob_start() 
         * 
         * FIN TAREA
        */ 

        ob_start();
        include $fileName;
        $content = ob_get_clean();

        $titulo_pagina = $data['titulo_pagina'] ?? $data['titulo'] ?? 'Agenda de Contactos';


        $layoutPath = VIEWS_DIR . '/layouts/base_view.php';
        if (file_exists($layoutPath)) {
            include $layoutPath;
        } else {
            echo $content; // Fallback si no hay layout
        }
    }
    

    protected function redirect($url) {
        $fullUrl = (strpos($url, 'http') === 0) ? $url : BASE_URL . $url;
        header('Location: ' . $fullUrl);
        exit;
    }

    public function mostrarError($mensaje, $codigo = 404) {
        http_response_code($codigo);
        $data = [
            'titulo'  => 'Ups! Algo ha ido mal',
            'mensaje' => $mensaje,
            'codigo'  => $codigo
        ];

        include VIEWS_DIR . '/errors/general_error.php';
        exit;
    }
}