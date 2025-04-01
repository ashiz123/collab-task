<?php

namespace utils;
use services\AuthService;

class AuthMiddleware{
    private $authService;

    public function __construct()
    {
        $this->authService = AuthService::getInstance();
    }

    public function handle(callable $next)
    {
        if($this->authService->isUserAuthenticated()){
            return $next();
        }else{
            http_response_code(403);
            echo 'Access Denied: Authentication required';
            exit;
        }
    }





}








?>