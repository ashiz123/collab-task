<?php

namespace Database\Migrations;

use config\Database;
use Illuminate\Database\Schema\Blueprint;
use App\Interfaces\MigrationInterface;

require_once __DIR__ . '/../vendor/autoload.php';


class UserRoleTable implements MigrationInterface {

    private $capsule;


    public function __construct($db)
    {
        $this->capsule = $db->getCapsule();
    }   
    
    public function up(){

        try{    
            if(!$this->capsule::schema()->hasTable('user_role')){
                $this->capsule::schema()->create('user_role', function(Blueprint $table){
                    $table->increments('id');
                    $table->unsignedInteger('user_id');
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

                    $table->unsignedInteger('role_id');
                    $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');


                    $table->unsignedInteger('assigned_by');
                    $table->foreign('assigned_by')->references('id')->on('users')->onDelete('cascade');

                    $table->timestamp('assigned_at');
                    $table->timestamps();

                    $table->unique('user_id', 'role_id');
                });

                echo 'User roles table created successfully'; 
            }else{
                echo 'User role table is already created';
            }
             
        }
        catch(\Exception $e){
            echo 'User role table cannot be created. Issue found' . $e->getMessage();
        }
       
    }

    public function down(){

        try{
            if($this->capsule::schema()->hasTable('user_role')){
                $this->capsule::schema()->drop('user_role');
                echo 'User role table dropped successfully';
            }else{
                echo 'User role table is not exist';
            }
        }
        catch(\Exception $e){
            echo 'User role table cannot be dropped with issue' . $e->getMessage(); 
        }

    }
}


$userRoleTable = new UserRoleTable(Database::getInstance());
$userRoleTable->up();