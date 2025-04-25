<?php
namespace migrations;
use interfaces\MigrationInterface;
use config\Database;
use Exception;
use Illuminate\Database\Schema\Blueprint;
require_once __DIR__ . '/../vendor/autoload.php';


class createNotificationTable implements MigrationInterface {

    public $capsule;

    public function __construct()
    {
        $this->capsule = Database::getInstance()->getCapsule();
    }


    public function up(){
        try{
            if(!$this->capsule::schema()->hasTable('notifications')){
                $this->capsule::schema()->create('notifications' , function (Blueprint $table) {
                    $table->increments('id');
                    $table->unsignedInteger('user_id');
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

                    $table->text('message');
                    $table->string('type')->nullable();
                    $table->timestamp('read_at')->nullable();
                    $table->timestamps();
                });

                echo 'Notification table created successfully';
            }else{
                echo 'Notification table already exist';
            }

           

        }
        catch(Exception $e){
            echo 'Error creating notification table' . $e->getMessage() . "\n";
        }
    }



    public function down(){
        if($this->capsule::schema()->hasTable('notifications')){
            $this->capsule::schema()->drop('notifications');
            echo 'Notifications table dropped successfully';
        }else{
            echo 'Notifications table does not exists';
        }
    }

}


$notifyMigration = new createNotificationTable();
$notifyMigration->up();





?>