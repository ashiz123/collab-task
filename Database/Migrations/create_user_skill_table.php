<?php
namespace Database\Migrations;

use App\Interfaces\MigrationInterface;
use config\Database;
use Exception;
use Illuminate\Database\Schema\Blueprint;

require_once __DIR__ . '/../vendor/autoload.php';


class CreateUserSkillTable implements MigrationInterface{
    private $capsule;

    public function __construct(Database $database)
    {
        $this->capsule = $database->getCapsule();
    }
   
    
    public function up()
    {

        try{
            if(!$this->capsule::schema()->hasTable('user_skill')){
                $this->capsule::schema()->create('user_skill', function (Blueprint $table) {
                     $table->id();
                     $table->unsignedInteger('user_id');
                     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                     $table->unsignedInteger('skill_id');
                     $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
                     $table->timestamps();
         
                     $table->unique(['user_id', 'skill_id']);
                 });

                 echo 'User skill table created successfully';
             }else{
                echo 'User skill table already exist';
             }
         

        }

        catch(Exception $e){
            echo $e->getMessage();
        }
      
    }

    public function down()
    {
        if($this->capsule::schema()->hasTable('user_skill')){
            $this->capsule::schema()->dropIfExists('user_skill');
            echo 'User skill table dropped successfully';
        }else{
            echo 'User skill table not exists';
        }
    }
}  


$userSkill = new CreateUserSkillTable(Database::getInstance());
$userSkill->up();






