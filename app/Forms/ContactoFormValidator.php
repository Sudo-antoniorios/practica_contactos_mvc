<?php

declare(strict_types=1);

namespace App\Forms;

class ContactoFormValidator
{
    public function validate(array $data): array
    {
        $errors = [];

        if (empty($data['nombre']) || mb_strlen((string) $data['nombre']) < 2) {
            $errors['nombre'] = 'El nombre es obligatorio (min. 2 caracteres)';
        }

        if (empty($data['email']) || !filter_var((string) $data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'El correo electronico no tiene un formato valido';
        }

        $soloNumeros = preg_replace('/[^\d]/', '', (string) ($data['telefono'] ?? ''));
        if (strlen($soloNumeros) < 9) {
            $errors['telefono'] = 'El telefono debe tener al menos 9 digitos';
        }

        return $errors;
    }
}
