<?php

namespace controllers;
use Models\Role;
use models\User;
use services\AuthService;

class RoleController {

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
       $this->authService = $authService;
      
    }

   


   


    }



