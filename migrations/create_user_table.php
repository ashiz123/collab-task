<?php

use Illuminate\Database\Capsule\Manager as Capsule;
require_once __DIR__ . '/../config/database.php';


class CreateUserTable {

    public function up(){
        if(!Capsule::schema()->hasTable('users')){
            Capsule::schema()->create('users', function($table){
                $table->increments('id');
                $table->string('email');
                $table->string('firstname');
                $table->string('lastname');
                $table->string('password');
            });

            echo 'User Table created successfully . \n';
        }else{
            echo 'User Table already exists. \n';
        }

    }

    public function down(){
        if(Capsule::schema()->hasTable('users')){
            Capsule::schema()->drop('users');
            echo 'User table dropped successfully . \n';
        }else{
            echo 'User table not exists . \n';
        }
    }



}

$userTable = new CreateUserTable();
$userTable->up();


?>

