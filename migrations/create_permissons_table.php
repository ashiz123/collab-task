<?php

namespace migrations;

use interfaces\MigrationInterface;
use config\Database;
use Illuminate\Database\Schema\Blueprint;
use utils\Logger;


require_once __DIR__ . '/../vendor/autoload.php';


class createPermissionsTable implements MigrationInterface {

    private $capsule;

    public function __construct(Database $database)
    {
        $this->capsule = $database->getCapsule();
    }

    public function up(){

        try{
            if(!$this->capsule::schema()->hasTable('permissions')){
                $this->capsule::schema()->create('permissions', function(Blueprint $table){
                $table->increments('id');
                $table->string('title')->unique();
                $table->text('description');
                $table->timestamps();

            });
             echo 'Permission table created successfully';
            }else{
                echo 'Permission table already exist';
            }
        }

        catch(\Exception $e){
            echo 'Failed to create the permissions table' . $e->getMessage();
        }
       

    }

    public function down(){
        if($this->capsule::schema()->hasTable('permissions')){
             $this->capsule::schema()->dropIfExists('permissions');
             echo 'Permissions table dropped successfully';
        }else{
            echo 'Permissions table is not exist';
        }
       
    }

}

$permissionsTable = new createPermissionsTable(Database::getInstance());
$permissionsTable->up();