<?php


namespace services;

use Exception;
use interfaces\AuthInterface;
use interfaces\UserInterface;
use Models\User;
use utils\Logger;


class UserService implements UserInterface{

    public function registerUser($email, $firstname, $lastname, $password): bool
{
    try {
        $user = new User;
        $user->email = $email;
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->password = $password;

        if ($user->save()) {
            return true;
        }
        return false;
    } catch (Exception $e) {
        error_log('User registration failed: ' . $e->getMessage());
        echo 'Error: ' . $e->getMessage();
        return false;
    }
}

    public function loginUser($email, $password){
        $user = User::where('email', $email)->first();
        if($user || $user->checkPassword($password)){
            return $user;
        }else{
            return null;
        }
    }



    
   

    

   

   




}







?>