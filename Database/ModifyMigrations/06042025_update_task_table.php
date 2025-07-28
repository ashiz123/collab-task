<?php
use config\Database;
require_once __DIR__ . '/../../vendor/autoload.php';
use Illuminate\Database\Schema\Blueprint;


try{
    $capsule = Database::getInstance()->getCapsule();
    $capsule::schema()->table('tasks', function (Blueprint $table){
      $table->enum('priority', ['high' , 'medium', 'low'])->nullable();
    });
    echo 'Tasks table modified successfully with priority column';

}

catch(Exception $e){
    echo "Failed to modify task table" . $e->getMessage();
}


?>