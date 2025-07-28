<?php
use config\Database;
require_once __DIR__ . '/../../vendor/autoload.php';
use Illuminate\Database\Schema\Blueprint;


try{
    $capsule = Database::getInstance()->getCapsule();
    $capsule::schema()->table('users', function(Blueprint $table){
        $table->dropColumn('role_id');
    });

    echo 'role_id deleted successfully';

}
catch(\Exception $e){
    echo 'Failed to delete column', $e->getMessage();
}


