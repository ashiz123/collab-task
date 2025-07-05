<?php
namespace Database\Migrations;
use App\Interfaces\MigrationInterface;
use config\Database;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use utils\Logger;

require_once __DIR__ . '/../vendor/autoload.php';


class createProfileInfoTable implements MigrationInterface {

    private $capsule;

    public function __construct(Database $database)
    {
        $this->capsule = $database->getCapsule();
        Logger::info('Creating profile info table');
    }

    public function up() {
        try{
           if(!$this->capsule::schema()->hasTable('profile_info')){
            $this->capsule::schema()->create('profile_info' , function(Blueprint $table){
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->string('avatar')->nullable();
                $table->text('bio')->nullable();
                $table->date('date_of_birth')->nullable();
                $table->string('phone_number')->nullable();
                $table->string('address')->nullable();
                $table->string('city')->nullable(); 
                $table->string('country')->nullable();
                $table->string('postal_code')->nullable();
                $table->string('website')->nullable();
                $table->string('social_media_links')->nullable();
                $table->timestamps();
            });

            echo 'Profile info table created successfully';
        }else{
            echo 'Profile info  table already exist';
        }
           
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function down() {    
        $this->capsule::schema()->dropIfExists('profile_info');
        echo 'Profile info table dropped successfully'; 
    }
}


$profile = new createProfileInfoTable(Database::getInstance());
$profile->up();

