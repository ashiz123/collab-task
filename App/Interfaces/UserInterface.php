<?php

namespace App\Interfaces;

use App\Models\User;

interface UserInterface {

    

    public function registerUser($email, $firstname, $lastname, $password) : User;

   

    public function loginUser($email, $password);


    public function getAllUsers();

    
    


  
}
?>