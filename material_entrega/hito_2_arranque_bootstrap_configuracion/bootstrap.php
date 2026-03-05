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
 * Cambia la definición de las constantes de rutas al fichero de configuración:
 * 
 * define('APP_ROOT',   realpath(__DIR__ . '/../'));
 * define('APP_DIR',    APP_ROOT . '/app');
 * define('PUBLIC_DIR', APP_ROOT . '/public');
 * define('VENDOR_DIR', APP_ROOT . '/vendor');
 * define('VIEWS_DIR',  APP_ROOT . '/views');
 * 
 * FIN TAREA
*/
// 

/*****************************************************
 * TAREA 3
 * 
 * Incluye carga de configuración y autoload:
 * 
 * require_once APP_DIR . '??????????????????????';
 * require_once VENDOR_DIR . '???????????????????';
 *    
 * FIN TAREA
*/

/*****************************************************
 * TAREA 4
 * 
 * Comenta el siguiente código *
 * 
 * FIN TAREA      
*/
if (file_exists(APP_DIR . '/helpers/helpers.php')) {
    require_once APP_DIR . '/helpers/helpers.php';
}


/*****************************************************
 * TAREA 5
 * 
 * Comenta el siguiente código *
 * 
 * FIN TAREA      
*/
use Dotenv\Dotenv;
try {
    $dotenv = Dotenv::createImmutable(APP_ROOT);
    $dotenv->load();
    $dotenv->required(['DBHOST', 'DBNAME', 'DBUSER', 'DBPASS'])->notEmpty();
} catch (Exception $e) {
    die('Fallo crítico en configuración: ' . $e->getMessage());
}


/*****************************************************
 * TAREA 6
 * 
 * Comenta el siguiente código *
 * 
 * FIN TAREA      
*/
define('APP_ENV', $_ENV['APP_ENV'] ?? 'production');
if (APP_ENV === 'dev') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $whoops = new \Whoops\Run;
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $whoops->register();
} else {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    ini_set('display_errors', 0);
}

/*****************************************************
 * TAREA 7
 * 
 * Comenta el siguiente código *
 * 
 * FIN TAREA      
*/
ini_set('log_errors', 1);
ini_set('error_log', APP_ROOT . '/logs/php_errors.log');
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
date_default_timezone_set($_ENV['TIMEZONE'] ?? 'Europe/Madrid');

// 7. MANTENIMIENTO DE DIRECTORIOS
$requiredDirs = [APP_ROOT . '/logs', APP_ROOT . '/cache', PUBLIC_DIR . '/uploads/contactos'];
foreach ($requiredDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}



// 9. URL BASE PARA VISTAS
// Fase 11: Definición de URL BASE
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$scriptDir = str_replace('/public', '', dirname($_SERVER['SCRIPT_NAME']));

// Eliminamos barras finales sobrantes para evitar el error de doble barra //
$baseUrl = rtrim($protocol . $host . $scriptDir, '/\\');
define('BASE_URL', $baseUrl);