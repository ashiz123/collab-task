<?php
//permission middleware

namespace App\Middlewares;


use App\Services\PermissionRegisteryService;
use utils\Logger;

class PermissionMiddleware{

    private $authService;
    private $permission;


    public function __construct($authService)
    {
        $this->authService = $authService;
        $this->permission = new PermissionRegisteryService();
    }

    public function handle(callable $next, $permission){
       
        try{
        $role = $this->authService->getAuthUserRole();
        if (!$role->hasPermission($permission)) {
            http_response_code(403);
            echo "Forbidden : Permission denied";
            return;
        } 

          return $next();
        }
    
    catch(\Exception $e){
            print_r('Server error'. $e->getMessage());
    }

}

 
}