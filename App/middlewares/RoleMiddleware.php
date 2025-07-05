<?php

namespace App\Middlewares;

class RoleMiddleware{

    private $authService;

    public function __construct($authService)
    {
        $this->authService =  $authService;
    }

    public function handle(callable $next){
        if($this->authService->getAuthUser() === null){
            echo "Forbidden: No any user logged in";
            exit;
        }


        if($this->authService->getAuthUserRole() !== null){
            if($this->authService->getAuthUserRole()->title !== 'admin'){
           http_response_code(403);
           echo 'Forbidden: admins only';
           exit;
        }
        }else{
             http_response_code(403);
             echo 'No role setup for the user';
             exit;
        }
        

         return $next();
    }
    
}
