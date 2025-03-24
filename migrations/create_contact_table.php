<?php

namespace migrations;
use config\Database;
require_once __DIR__ . '/../vendor/autoload.php';


class CreateContactTable{


    //it uses Database class with getCapsule() method.
    public function up(){
        try{
            $capsule = Database::getInstance()->getCapsule();
            if(!$capsule->schema()->hasTable('contact')){
                $capsule->schema()->create('contact', function($table){
                    $table->increments('id');
                    $table->string('email');
                    $table->string('name');
                    $table->string('phone');
                    $table->string('message');
                    $table->timestamps();
                });
                echo 'Contact table created successfully';
            }else{
                echo 'Table Contact already exists . \n';
            }
            
        }
        
        catch(\Exception $e){
             echo "Error Creating the table: ". $e->getMessage() . '\n';
        }
    }



    //it uses Capsule::schema()
    public function down(){
        try{
            $capsule = Database::getInstance()->getCapsule();
            if($capsule::schema()->hasTable('contact')){
                $capsule::schema()->drop('contact');
                echo "Contact table dropped successfully . \n";
            }else{
                echo "Contact table is not exists  . \n";
            }

        }
        catch(\Exception $e){
            echo ('Problem creating table'.  $e->getMessage());
        }
    }


}


$contactMigration = new CreateContactTable();
$contactMigration->up();




?>