<?php

namespace App\Services;
use App\Interfaces\AuthInterface;
use App\Models\User;
use utils\Logger;

class AuthService implements AuthInterface{


    private static $instance;

    // Private constructor to prevent instantiation outside of this class
    private function __construct() {}

    // Clone method is private to prevent duplication of the instance
    private function __clone() {}

    // Get the single instance of the AuthService
    public static function getInstance(): AuthInterface {
        if (self::$instance === null) {
            self::$instance = new self();  // Create the instance if it doesn't exist
        }
        return self::$instance;
    }



    public function setAuthUser($user){
        session_start();
        session_regenerate_id(true); 
        $_SESSION['auth_user'] = [ 'id' => $user->id, 'email' => $user->email, 'firstname' => $user->firstname, 'lastname' => $user->lastname];
    }



    public function getAuthUser(){
        if(!empty($_SESSION['auth_user'])){
            return $_SESSION['auth_user'];
        }
        return null;
    }

    public function getAuthId() : ?int{
        if(!empty($_SESSION['auth_user'])){
            return $_SESSION['auth_user']['id'];
        }
        return null;
    }

    public function getAuthenticateUser() : ?User{
        $user = User::find($_SESSION['auth_user']['id']);
        return $user;
        
    }

     public function getAuthUserRole(){
       try{
        
        $user = $this->getAuthenticateUser();
        
        if(!$user){
             return 'user not found';
        }
        return $user->role;
       
       }
       catch(\Exception $e){
        return 'Error occured:'. $e->getMessage();
       }
    }
    

    

    public function isUserAuthenticated(): bool {
      return isset($_SESSION['auth_user']);
    }


    public function removeAuthUser()
    {
        session_start();
        session_unset();
        session_destroy();

        session_start();
        $_SESSION['message'] = 'user logged out successfully';
    }
    



}





?>