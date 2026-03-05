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
 * Documenta cada una de las propiedades y métodos de la clase. 
 * 
 * FIN TAREA
*/


class ContactoFormValidator
{
    public function validate(array $data): array
    {
        $errors = [];
        
        if (empty($data['nombre']) || mb_strlen($data['nombre']) < 2) {
            $errors['nombre'] = 'El nombre es obligatorio (mín. 2 caracteres)';
        }

        /*****************************************************
         * TAREA 3
         * 
         * Validación de correo electrónico 
         * 
         * FIN TAREA
        */

        $soloNumeros = preg_replace('/[^\d]/', '', $data['telefono'] ?? '');
        if (strlen($soloNumeros) < 9) {
            $errors['telefono'] = 'El teléfono debe tener al menos 9 dígitos';
        }

        return $errors;
    }
}