<?php

use config\Database;
require_once __DIR__ . '/../vendor/autoload.php';
use Illuminate\Database\Schema\Blueprint;

try{
    $capsule = Database::getInstance()->getCapsule();
    $capsule::schema()->table('tasks', function(Blueprint $table) {
        $table->unsignedInteger('user_id')->nullable()->after('id');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });

    echo 'Table task modified successfully . \n';
}

catch(\Exception $e){
    echo "Failed to modify the task table" . $e->getMessage() . "\n";
}





?>