<?php

declare(strict_types=1);

namespace App\Models;

class DatabaseException extends \Exception
{
    public function logError(): void
    {
        error_log('DATABASE ERROR [' . date('Y-m-d H:i:s') . ']: ' . $this->getMessage());
    }

    public function getUserMessage(): string
    {
        return 'Error de base de datos. Por favor, intente mas tarde.';
    }
}
