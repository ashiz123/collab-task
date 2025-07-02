<?php

namespace migrations;

use interfaces\MigrationInterface;
use config\Database;
use Illuminate\Database\Schema\Blueprint;
use utils\Logger;

require_once __DIR__ . '/../vendor/autoload.php';


class createProfileTable implements MigrationInterface {

    private $capsule;

    public function __construct(Database $database)
    {
        $this->capsule = $database->getCapsule();
        Logger::info('Creating profile table');
    }

    public function up() {
        $this->capsule::schema()->create('profile', function(Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('is_profile_completed')->default(false);
            $table->boolean('is_skill_completed')->default(false);
            $table->boolean('is_education_completed')->default(false);
            $table->timestamps();
        });

        echo 'Profile table created successfully';
    }
    


    public function down() {
        $this->capsule::schema()->dropIfExists('profile');
    }
}

$profile = new createProfileTable(Database::getInstance());
$profile->up();