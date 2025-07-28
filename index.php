<?php

declare(strict_types=1);
// Enable error reporting
error_reporting(E_ALL);  // Report all errors
ini_set('display_errors', 1);  // Display errors on the screen
header('Content-Type: text/html; charset=UTF-8');
require_once __DIR__ .  '/./vendor/autoload.php';
ob_start();
require_once  './routes.php';
ob_end_flush();
// require_once './config/Database.php';
?>




