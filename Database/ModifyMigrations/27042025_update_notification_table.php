<?php

use config\Database;
require_once __DIR__ . '/../vendor/autoload.php';
use Illuminate\Database\Schema\Blueprint;


try{
  $capsule = Database::getInstance()->getCapsule();
  $capsule::schema()->table('notifications' , function(Blueprint $table){
    $table->unsignedInteger('assign_id')->nullable()->after('user_id');
    $table->foreign('assign_id', 'notifications_assign_id_foreign')->references('id')->on('task_assignment')->onDelete('cascade');
    $table->string('title')->nullable()->after('assign_id');
  });

  echo "Notifications  modified successfully with assign_id and title added";

}

catch(\Exception $e){
 echo 'Failed to add title and assignId' . $e->getMessage();
}





?>