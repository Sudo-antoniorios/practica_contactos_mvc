<?php

declare(strict_types=1);

/**
 * Bootstrap global de la aplicacion.
 *
 * Inicializa rutas base, carga configuracion, autoload de Composer,
 * variables de entorno, modo de errores y ajustes de seguridad.
 */

// Rutas principales del proyecto.
define('APP_ROOT', realpath(__DIR__ . '/..'));
define('APP_DIR', APP_ROOT . '/app');
define('PUBLIC_DIR', APP_ROOT . '/public');
define('VENDOR_DIR', APP_ROOT . '/vendor');
define('VIEWS_DIR', APP_ROOT . '/views');

// Configuracion base de la app y autocargado PSR-4 de Composer.
require_once APP_DIR . '/config/parametros.php';
require_once VENDOR_DIR . '/autoload.php';

// Helpers globales opcionales para funciones de apoyo.
if (file_exists(APP_DIR . '/helpers/helpers.php')) {
    require_once APP_DIR . '/helpers/helpers.php';
}

// Carga .env y fuerza presencia de variables criticas para DB.
use Dotenv\Dotenv;

try {
    $dotenv = Dotenv::createImmutable(APP_ROOT);
    $dotenv->load();
    $dotenv->required(['DBHOST', 'DBNAME', 'DBUSER'])->notEmpty();
} catch (Exception $e) {
    die('Fallo critico en configuracion: ' . $e->getMessage());
}

// Modo de errores segun entorno: trazas en desarrollo, ocultas en produccion.
define('APP_ENV', $_ENV['APP_ENV'] ?? 'production');
if (APP_ENV === 'dev') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    $whoops = new \Whoops\Run();
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler());
    $whoops->register();
} else {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
    ini_set('display_errors', '0');
}

// Ajustes de logging, sesion y zona horaria.
ini_set('log_errors', '1');
ini_set('error_log', APP_ROOT . '/logs/php_errors.log');
ini_set('session.cookie_httponly', '1');
ini_set('session.use_strict_mode', '1');
date_default_timezone_set($_ENV['TIMEZONE'] ?? 'Europe/Madrid');

// Crea carpetas necesarias en primera ejecucion.
$requiredDirs = [
    APP_ROOT . '/logs',
    APP_ROOT . '/cache',
    PUBLIC_DIR . '/uploads/contactos',
];

foreach ($requiredDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// URL base para generar enlaces desde vistas.
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '/public/index.php';
$scriptDir = str_replace('/public', '', dirname($scriptName));

$baseUrl = rtrim($protocol . $host . $scriptDir, '/\\');
define('BASE_URL', $baseUrl);
