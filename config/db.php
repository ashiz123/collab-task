<?php
use Illuminate\Database\Capsule\Manager as Capsule;

require_once __DIR__ .  '/../vendor/autoload.php';

$capsule = new Capsule;

// Database connection settings
$capsule->addConnection([
    'driver'    => 'mysql',  // Database type (MySQL, PostgreSQL, etc.)
    'host'      => '127.0.0.1',  // Database host
    'database'  => 'todo_app',  // Database name
    'username'  => 'root',  // Database username
    'password'  => 'yankee123',  // Database password
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);
 
// Make Capsule globally available
$capsule->setAsGlobal();
$capsule->bootEloquent();


try{
    Capsule::connection()->getPdo();
    // echo "✅ Database connection is successful!";
}

catch(Exception $e)
{
    die('Connection failed' . $e->getMessage());
}
?>