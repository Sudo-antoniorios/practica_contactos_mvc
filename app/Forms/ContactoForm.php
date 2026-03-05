<?php

declare(strict_types=1);

namespace App\Forms;

class ContactoForm
{
    private array $data = [];
    private array $errors = [];
    private ContactoFormSanitizer $sanitizer;
    private ContactoFormValidator $validator;

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
            'errors' => $this->errors,
            'data' => $this->getValidatedData(),
            'form' => $this->getFormData(),
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
