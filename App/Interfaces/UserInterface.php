<?php

namespace App\Interfaces;



interface UserInterface {

    

    public function registerUser($email, $firstname, $lastname, $password);

    public function verifyOtp($otp);

    public function loginUser($email, $password);
    


  
}
?>