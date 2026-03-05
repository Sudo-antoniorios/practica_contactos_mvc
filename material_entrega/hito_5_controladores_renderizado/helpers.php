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
 * Documenta la función
 * 
 * FIN TAREA
*/
function diasTranscurridos(string $fecha): string 
{
    $fechaInicio = new DateTime($fecha);
    $hoy = new DateTime();
    $diferencia = $hoy->diff($fechaInicio);
    
    $dias = $diferencia->days;

    if ($dias === 0) return "Creado hoy";
    if ($dias === 1) return "Creado ayer";
    return "Hace $dias días";
}