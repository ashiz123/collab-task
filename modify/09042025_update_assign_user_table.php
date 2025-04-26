<?php

use config\Database;
require_once __DIR__ . '/../vendor/autoload.php';
use Illuminate\Database\Schema\Blueprint;

try{
    $capsule = Database::getInstance()->getCapsule();
    $capsule::schema()->table('task_assignment', function(Blueprint $table){
        $table->unique(['user_id', 'task_id']);
    });

    echo "Task assignment modified successfully with user and task combination unique";

}

catch(\Exception $e){
    echo "Failed to modify the task table" . $e->getMessage() . "\n";
}

?>