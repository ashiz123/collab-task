<?php

use config\Database;
require_once __DIR__ . '/../vendor/autoload.php';
use Illuminate\Database\Schema\Blueprint;

try{
    $capsule = Database::getInstance()->getCapsule();
    $capsule::schema()->table('users' ,function(Blueprint $table){
        $table->string('otp', 10)->nullable()->after('password');
        $table->timestamp('otp_expires')->nullable()->after('otp');
        $table->tinyInteger('is_verified')->default(0)->after('otp_expires');
    });
    echo 'User table modified successfully';
}

catch(\Exception $e){
    echo "Failed to modify the task table" . $e->getMessage() . "\n";
}








?>