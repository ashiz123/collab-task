<?php


use config\Database;
require_once __DIR__ . '/../../vendor/autoload.php';
use Illuminate\Database\Schema\Blueprint;

try{
    $capsule = Database::getInstance()->getCapsule();
     if($capsule::schema()->hasTable('user_role')){
        $capsule::schema()->table('user_role', function(Blueprint $table){
            $table->unique('user_id', 'role_id');
        });

        echo 'user_id and role_id table unique relationship created';
    }else{
        echo 'User table is not exist';
    }
}

catch(\Exception $e){
     echo 'user_id and role_id table unique relationship cannot created'. $e->getMessage();
}