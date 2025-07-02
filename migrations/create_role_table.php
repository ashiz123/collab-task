<?php

namespace migrations;

use interfaces\MigrationInterface;
use config\Database;
use Illuminate\Database\Schema\Blueprint;
use utils\Logger;


require_once __DIR__ . '/../vendor/autoload.php';


class createRoleTable implements MigrationInterface {

    private $capsule;

    public function __construct(Database $database)
    {
        $this->capsule = $database->getCapsule();
    }

    public function up(){

        try{
            if(!$this->capsule::schema()->hasTable('role')){
                $this->capsule::schema()->create('role', function(Blueprint $table){
                $table->increments('id');
                $table->string('title')->unique();
                $table->text('description');
                $table->timestamps();

            });
             echo 'Role table created successfully';
            }else{
                echo 'Role table already exist';
            }
        }

        catch(\Exception $e){
            echo 'Failed to create the role table' . $e->getMessage();
        }
       

    }

    public function down(){
        if($this->capsule::schema()->hasTable('role')){
             $this->capsule::schema()->dropIfExists('role');
             echo 'Role table dropped successfully';
        }else{
            echo 'Role table is not exist';
        }
       
    }

}

$roleTable = new createRoleTable(Database::getInstance());
$roleTable->up();