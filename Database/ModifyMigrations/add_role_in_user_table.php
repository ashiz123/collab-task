<?php

use config\Database;
require_once __DIR__ . '/../vendor/autoload.php';
use Illuminate\Database\Schema\Blueprint;


try {
    $capsule = Database::getInstance()->getCapsule();
    if($capsule::schema()->hasTable('users')){
        $capsule::schema()->table('users', function(Blueprint $table){
            $table->unsignedInteger('role_id')->default(0);
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
        });

        echo 'User table update successfully with role column';
    }else{
        echo 'User table is not exist';
    }
}
catch(\Exception $e){
    echo 'User table cannot be updated with role column'. $e->getMessage();
}