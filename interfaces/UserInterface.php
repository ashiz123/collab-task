<?php

namespace interfaces;

use models\User;

interface UserInterface {

    public function registerUser($email, $firstname, $lastname, $password);

    public function loginUser($email, $password);
    


  
}
?>