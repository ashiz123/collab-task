<?php

namespace Database\Migrations;

use App\Interfaces\MigrationInterface;
use config\Database;
use Illuminate\Database\Schema\Blueprint;

require_once __DIR__ . '/../vendor/autoload.php';

class createRolePermissionsTable implements MigrationInterface{

    private $capsule;

    public function __construct($database)
    {
        $this->capsule = $database->getCapsule();
    }

    public function up(){
        try{
            if(!$this->capsule::schema()->hasTable('role_permission')){
                  $this->capsule::schema()->create('role_permissions', function(Blueprint $table){
                    $table->increments('id');

                    $table->unsignedInteger('role_id');
                    $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');

                    $table->unsignedInteger('permission_id');
                    $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            });

            echo 'Role permission table has created successfully';
            }else{
                echo 'Role permission table already exist';
            }
        }
        catch(\Exception $e){
            echo 'Problem creating role permssion table' . $e->getMessage();
        }
    }

    public function down(){
        if($this->capsule::schema()->hasTable('role_permissions')){
            $this->capsule::schema()->dropIfExists('role_permissions');
            echo 'Role permissions table dropped successfully';
        }else{
            echo 'Role permissions table is not exist';
        }

    }

}

$profile = new createRolePermissionsTable(Database::getInstance());
$profile->up();