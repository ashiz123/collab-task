<?php

 namespace interfaces;


 interface AuthInterface {


    public function setAuthUser($user);

    public function getAuthUser();

    public function getAuthId();

    public function removeAuthUser();

    public function isUserAuthenticated(): bool;

  }


?>