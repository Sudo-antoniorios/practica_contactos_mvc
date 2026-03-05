<?php

declare(strict_types=1);

namespace App\Forms;

class ContactoFormSanitizer
{
    public function sanitize(array $data): array
    {
        $sanitized = [];
        foreach ($data as $key => $value) {
            $sanitized[$key] = $this->sanitizeField((string) $key, $value);
        }
        return $sanitized;
    }

    public function sanitizeForOutput(array $data): array
    {
        return array_map(static function ($value): string {
            return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
        }, $data);
    }

    private function sanitizeField(string $field, $value)
    {
        if (!is_string($value)) {
            return $value;
        }

        $value = trim($value);

        return match ($field) {
            'nombre' => mb_convert_case((string) preg_replace('/[^\p{L}\s\-\.\']/u', '', $value), MB_CASE_TITLE, 'UTF-8'),
            'telefono' => preg_replace('/[^\d+]/', '', $value),
            'email' => filter_var(mb_strtolower($value), FILTER_SANITIZE_EMAIL),
            default => $value,
        };
    }
}
