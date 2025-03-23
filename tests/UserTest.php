<?php 
declare(strict_types=1);

use models\User;
use PHPUnit\Framework\TestCase;
use config\Database;


class UserTest extends TestCase{

    protected function setUp(): void{
        parent::setUp();
        $this->createUsersTable();
    }


    protected function createUsersTable()
    {
        $capsule = Database::getInstance()->getCapsule();//get capusle instance
        $capsule->schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('firstname');
            $table->string('lastname');
            $table->timestamps();
        });
    }

   

    public function testPasswordIsHashedOnSave(){
        $user = new User();
        $user->email = 'testuser@gmail.com';
        $user->password = 'test123';
        $user->firstname = 'Ashiz';
        $user->lastname = 'Hamal';
        $user->save();


        $savedUser = User::where('email', $user->email)->first();
        $this->assertNotEquals('test123', $savedUser->password);
        $this->assertTrue(password_verify('test123', $savedUser->password));

        $savedUser->delete();
    }


    protected function tearDown(): void{
        Database::getInstance()->getCapsule()->schema()->dropIfExists('users');
        parent::tearDown();
    }
}





?>