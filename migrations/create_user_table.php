<?php


namespace migrations;
require_once __DIR__ . '/../vendor/autoload.php';
use config\Database;


class CreateUserTable {

    public function up(){
        $capsule = Database::getInstance()->getCapsule();
        if(!$capsule::schema()->hasTable('users')){
            $capsule::schema()->create('users', function($table){
                $table->increments('id');
                $table->string('email');
                $table->string('firstname');
                $table->string('lastname');
                $table->string('password');
                $table->timestamps();
                
            });

            echo 'User Table created successfully . \n';
        }else{
            echo 'User Table already exists. \n';
        }

    }

    public function down(){
        $capsule = Database::getInstance()->getCapsule();
        if($capsule::schema()->hasTable('users')){
            $capsule::schema()->drop('users');
            echo 'User table dropped successfully . \n';
        }else{
            echo 'User table not exists . \n';
        }
    }



}

$userTable = new CreateUserTable();
$userTable->up();


?>

