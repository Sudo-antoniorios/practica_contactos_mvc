<?php

function view_contacto_avatar($nombre, $size = 40) {
    $inicial = strtoupper(substr(trim($nombre), 0, 1));
    $colores = ['primary', 'success', 'info', 'danger', 'secondary', 'dark'];
    $indiceColor = ord($inicial) % count($colores);
    $colorClase = $colores[$indiceColor];

    return "
    <div class='rounded-circle bg-{$colorClase} text-white d-flex align-items-center justify-content-center shadow-sm' 
         style='width: {$size}px; height: {$size}px; font-weight: bold; font-size: " . ($size * 0.4) . "px;'>
        {$inicial}
    </div>";
}