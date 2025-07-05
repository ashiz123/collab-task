<?php

 namespace App\Interfaces;


 interface AuthInterface {


    public function setAuthUser($user);

    public function getAuthUser();

    public function getAuthUserRole();

    public function getAuthId();

    public function removeAuthUser();

    public function isUserAuthenticated(): bool;


  }


?>