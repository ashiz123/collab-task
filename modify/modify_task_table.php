



<?php

require_once __DIR__ . '/../config/database.php';
use illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

try{
    Capsule::schema()->table('tasks', function(Blueprint $table) {
        $table->timestamp('deleted_at')->nullable();
        // $table->unsignedInteger('user_id')->nullable()->after('id');
        // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });

    echo 'Table task modified successfully . \n';
}

catch(\Exception $e){
    echo "Failed to modify the task table" . $e->getMessage() . "\n";
}





?>