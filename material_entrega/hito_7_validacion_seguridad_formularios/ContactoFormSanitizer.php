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
 *
 */

class ContactoFormSanitizer
{
    public function sanitize(array $data): array
    {
        $sanitized = [];
        foreach ($data as $key => $value) {
            $sanitized[$key] = $this->sanitizeField($key, $value);
        }
        return $sanitized;
    }

 
    public function sanitizeForOutput(array $data): array
    {
        return array_map(function($value) {
            return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
        }, $data);
    }

    private function sanitizeField(string $field, $value)
    {
        if (!is_string($value)) return $value;
        $value = trim($value);

        return match ($field) {
            'nombre'   => mb_convert_case(preg_replace('/[^\p{L}\s\-\.\']/u', '', $value), MB_CASE_TITLE, "UTF-8"),
            'telefono' => preg_replace('/[^\d+]/', '', $value),
            'email'    => filter_var(mb_strtolower($value), FILTER_SANITIZE_EMAIL),
            default    => $value,
        };
    }
}