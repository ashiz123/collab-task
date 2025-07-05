<?php

namespace App\Middlewares;


class AuthMiddleware{
    private $authService;

    public function __construct($authService)
    {
        $this->authService =$authService;
    }

    public function handle(callable $next)
    {
        if($this->authService->isUserAuthenticated()){
            return $next();
        }else{
            http_response_code(403);
            $_SESSION['response'] = "You must login to create and view tasks";
            header('Location: /login-user' );
            exit;
        }
    }





}








?>