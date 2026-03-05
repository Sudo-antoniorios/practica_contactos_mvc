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

namespace App\Forms;

class ContactoForm
{
    private array $data = [];
    private array $errors = [];


    public function __construct(array $data = [])
    {
        $this->sanitizer = new ContactoFormSanitizer();
        $this->validator = new ContactoFormValidator();
  
        $this->data = !empty($data) ? $this->sanitizer->sanitize($data) : $this->getDefaultData();
    }


    public function validate(array $data): array
    {

        $this->data = $this->sanitizer->sanitize($data);
        

        $this->errors = $this->validator->validate($this->data);

        return [
            'is_valid' => empty($this->errors),
            'errors'   => $this->errors,
            'data'     => $this->getValidatedData(), 
            'form'     => $this->getFormData()      
        ];
    }

  
    public function sanitizeForOutput(array $data): array
    {
        return $this->sanitizer->sanitizeForOutput($data);
    }

    public function getValidatedData(): array
    {
      
        return array_intersect_key($this->data, array_flip(['nombre', 'telefono', 'email']));
    }

    public function getFormData(): array
    {
        return array_merge($this->getDefaultData(), $this->data);
    }

    public function getDefaultData(): array
    {
        return ['nombre' => '', 'telefono' => '', 'email' => ''];
    }
}