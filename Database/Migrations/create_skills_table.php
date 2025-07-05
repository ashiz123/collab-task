<?php
namespace Database\Migrations;
use App\Interfaces\MigrationInterface;
use config\Database;
use Exception;
use Illuminate\Database\Schema\Blueprint;

require_once __DIR__ . '/../vendor/autoload.php';

class CreateSkillsTable implements MigrationInterface {
    private $capsule;

    public function __construct(Database $database)
    {
        $this->capsule = $database->getCapsule();
    }

    public function up() {
        try {
            // Create skills table
            if(!$this->capsule::schema()->hasTable('skills')) {
                $this->capsule::schema()->create('skills', function(Blueprint $table) {
                    $table->increments('id');
                    // $table->unsignedInteger('user_id');
                    // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                    $table->string('name')->unique();
                    $table->text('description')->nullable();
                    $table->timestamps();
                });

                echo 'Skill table created successfully';
            }else{
                echo 'Skill table already exist';
            }
            
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function down() {    
        $this->capsule::schema()->dropIfExists('skills');
    }
} 

$skills = new CreateSkillsTable(Database::getInstance());
$skills->up();






