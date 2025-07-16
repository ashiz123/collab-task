<?php
//permission middleware

namespace App\Middlewares;


use App\Services\PermissionRegisteryService;

class PermissionMiddleware{

    private $authService;
    private $permission;


    public function __construct($authService)
    {
        $this->authService = $authService;
        $this->permission = new PermissionRegisteryService();
    }

    public function handle(callable $next, $permission){
       
        $role_title = $this->authService->getAuthUserRole()->title;
        if(!$this->authService->getAuthenticateUser() || !$this->permission->doRoleHasPermission($role_title, $permission)){
            http_response_code(403);
            echo "Forbidden : Permission denied";
            return;
        }

        return $next();
     }

}

 
