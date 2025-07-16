<?php

use config\Database;
require_once __DIR__ . '/../../vendor/autoload.php';
use Illuminate\Database\Schema\Blueprint;

try{
    $capsule = Database::getInstance()->getCapsule();
    $capsule::schema()->table('users' ,function(Blueprint $table){
        $table->unsignedInteger('role_id')->default(0);
        $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
    });
    echo 'User table modified successfully with adding role_id';
}

catch(\Exception $e){
    echo "Failed to modify the task table" . $e->getMessage() . "\n";
}

?>