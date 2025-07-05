<?php

namespace App\Controllers;
use Models\Role;
use models\User;
use App\Services\AuthService;

class RoleController {

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
       $this->authService = $authService;
      
    }

   


   


    }



