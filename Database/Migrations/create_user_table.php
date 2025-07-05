<?php


namespace Database\Migrations;
require_once __DIR__ . '/../vendor/autoload.php';
use config\Database;
use App\Interfaces\MigrationInterface;


class CreateUserTable implements MigrationInterface {

    public function up(){
        $capsule = Database::getInstance()->getCapsule();
        if(!$capsule::schema()->hasTable('users')){
            $capsule::schema()->create('users', function($table){
                $table->increments('id');
                $table->string('email');
                $table->string('firstname');
                $table->string('lastname');
                $table->string('password');
                $table->string('otp', 10)->nullable();
                $table->timestamp('otp_expires')->nullable();
                $table->tinyInteger('is_verified')->default(0);

                // $table->unsignedInteger('role_id');
                // $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');

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

