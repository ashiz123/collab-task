<?php

use config\Database;
require_once __DIR__ . '/../vendor/autoload.php';
use Illuminate\Database\Schema\Blueprint;


try{
    $capsule = Database::getInstance()->getCapsule();
    $capsule::schema()->table('tasks', function(Blueprint $table){
        $table->timestamp('deleted_at')->nullable();
    });
    echo "deleted_at column added successfully";
}
catch(\Exception $e){
    echo "Failed to add deleted at column" . $e->getMessage() . "\n";
}




?>