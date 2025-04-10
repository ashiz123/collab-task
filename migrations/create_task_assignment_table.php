<?php

namespace migrations;

use interfaces\MigrationInterface;
use config\Database;
use Exception;
use Illuminate\Database\Schema\Blueprint;
require_once __DIR__ . '/../vendor/autoload.php';

class CreateTaskAssignmentTable implements MigrationInterface{

    public $capsule;

    public function __construct()
    {
        $this->capsule =  Database::getInstance()->getCapsule();
    }

    public function up(){
        try{
            
            if(!$this->capsule::schema()->hasTable('task_assignment')){
                $this->capsule::schema()->create('task_assignment' , function(Blueprint $table){
                    $table->increments('id');
                    $table->unsignedInteger('user_id');
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

                    $table->unsignedInteger('task_id');
                    $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');

                    $table->string('role_name');
                    $table->enum('status', ['pending', 'complete', 'review', 'cancel'])->default('pending');
                    $table->timestamp('deadline')->nullable();
                    $table->enum('priority', ['high', 'moderate', 'low'])->default('low');
                    $table->timestamps();

                    $table->unique(['user_id', 'task_id']);
                });

                echo 'Table Task assignment created successfully';
            }else{
                echo 'Table task assignment already exist';
            }
        }
        catch(Exception $e){
            echo "Error Creating the table: ". $e->getMessage() . '\n';
        }
    }


    public function down(){
        if($this->capsule::schema()->hasTable('task_assignment')){
            $this->capsule::schema()->drop('task_assignment');
            echo 'Task assignment table is dropped successfully';
        }   else{
            echo 'Task assignment table does not exists';
        }
    }


}



$taskAssignment = new CreateTaskAssignmentTable();
$taskAssignment->up();






?>