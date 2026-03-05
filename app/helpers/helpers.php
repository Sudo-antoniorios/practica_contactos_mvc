<?php

declare(strict_types=1);

function diasTranscurridos(string $fecha): string
{
    $fechaInicio = new DateTime($fecha);
    $hoy = new DateTime();
    $diferencia = $hoy->diff($fechaInicio);

    $dias = $diferencia->days;

    if ($dias === 0) {
        return 'Creado hoy';
    }

    if ($dias === 1) {
        return 'Creado ayer';
    }

    return "Hace {$dias} dias";
}
