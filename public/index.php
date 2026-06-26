<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
$maintenanceLocal = __DIR__.'/../storage/framework/maintenance.php';
$maintenanceServer = __DIR__.'/../../mindmatch_mesin/storage/framework/maintenance.php';

if (file_exists($maintenanceLocal)) {
    require $maintenanceLocal;
} elseif (file_exists($maintenanceServer)) {
    require $maintenanceServer;
}

// Register the Composer autoloader...
$autoloaderLocal = __DIR__.'/../vendor/autoload.php';
$autoloaderServer = __DIR__.'/../../mindmatch_mesin/vendor/autoload.php';

if (file_exists($autoloaderLocal)) {
    require $autoloaderLocal;
} elseif (file_exists($autoloaderServer)) {
    require $autoloaderServer;
} else {
    die("Autoloader not found. Please run 'composer install'.");
}

// Bootstrap Laravel and handle the request...
$appLocal = __DIR__.'/../bootstrap/app.php';
$appServer = __DIR__.'/../../mindmatch_mesin/bootstrap/app.php';

if (file_exists($appLocal)) {
    $app = require_once $appLocal;
} elseif (file_exists($appServer)) {
    $app = require_once $appServer;
} else {
    die("Bootstrap app.php not found.");
}

$app->handleRequest(Request::capture());
