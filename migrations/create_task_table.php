<?php

require_once __DIR__  . '/../config/database.php';
use Illuminate\Database\Capsule\Manager as Capsule;

class CreateTasksTable{

    public function up(){
        if(!Capsule::schema()->hasTable('tasks')){
            Capsule::schema()->create('tasks', function($table){
                $table->increments('id');
                $table->string('task');
                $table->string('description');
                $table->enum('status', ['pending', 'completed'])->defualt('pending');
                $table->timestamps();
            });
            echo 'Task table created successfully using eleoquent. \n';
        }
        else{
            echo 'Table already exists';
        }
    }

    public function down(){
        if(Capsule::schema()->hasTable('tasks')){
            Capsule::schema()->drop('tasks');
            echo "Table tasks dropped successfully. \n";
        }else{
            echo 'Tasks table does not exsits';
        }
    }

}

$taskMigration = new CreateTasksTable();
$taskMigration->up();


?>