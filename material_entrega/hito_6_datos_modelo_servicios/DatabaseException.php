<?php
namespace App\Models;

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
 * Documenta cada una de las propiedades y métodos de la clase. 
 * 
 * FIN TAREA
*/
class DatabaseException extends \Exception
{

    public function logError() {
        error_log("DATABASE ERROR [" . date('Y-m-d H:i:s') . "]: " . $this->getMessage());
    }
    

    public function getUserMessage() {
        return "Error de base de datos. Por favor, intente más tarde.";
    }
}
?>