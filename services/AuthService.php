<?php

namespace services;
use interfaces\AuthInterface;

class AuthService implements AuthInterface{


    public function setAuthUser($user){
        session_start();
        session_regenerate_id(true); 
        $_SESSION['auth_user'] = [ 'email' => $user->email, 'firstname' => $user->firstname, 'lastname' => $user->lastname];
    }



    public function getAuthUser(){
        if(!empty($_SESSION['auth_user'])){
            return $_SESSION['auth_user'];
        }

        return null;
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