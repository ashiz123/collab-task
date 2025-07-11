<?php

namespace Database\Migrations;
use App\Interfaces\MigrationInterface;
use config\Database;
require_once __DIR__ . '/../vendor/autoload.php';

class CreateTasksTable implements MigrationInterface{

    public $capsule;

    public function __construct()
    {
        $this->capsule =  Database::getInstance()->getCapsule();
    }

    public function up(){
       
        if(!$this->capsule::schema()->hasTable('tasks')){
            $this->capsule::schema()->create('tasks', function($table){
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('task');
                $table->string('description');
                $table->enum('status', ['pending', 'completed'])->defualt('pending');
                $table->timestamp('deleted_at')->nullable();
                $table->enum('priority', ['high' , 'medium', 'low'])->nullable();
                $table->timestamps();
            });
            echo 'Task table created successfully using eleoquent. \n';
        }
        else{
            echo 'Task table already exists';
        }
    }

    public function down(){
        if($this->capsule::schema()->hasTable('tasks')){
            $this->capsule::schema()->drop('tasks');
            echo "Table tasks dropped successfully. \n";
        }else{
            echo 'Tasks table does not exsits';
        }
    }

}

$taskMigration = new CreateTasksTable();
$taskMigration->up();


?>