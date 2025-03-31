<?php
namespace controllers;

use services\AuthService;
use models\User;
use services\UserService;
use utils\Logger;

// use Respect\Validation\Validator as validation;




class UserController {
    protected  $userService;
    protected $authService;



    public function __construct()
    {
        $this->userService = new UserService();
        $this->authService = AuthService::getInstance();
    }

    public function register(){
        
        $email = trim($_POST['email']);
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $password = trim($_POST['password']);

        $errors = User::validateRegisterUser($email, $firstname, $lastname, $password);

       if(empty($errors)){
       if($this->userService->registerUser($email, $firstname, $lastname, $password)){
         Logger::info('user registered successfully');
         header("Location: /login-user");
       }
    }
       else{
        foreach($errors as $error){
            echo "<p> $error </p>";
        }
       }
    }

    public function login(){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $errors = User::validateLoginUser($email, $password);
        
       
        if(empty($errors)){

            $user = $this->userService->loginUser($email, $password);
            if($user !== null){
                $this->authService->setAuthUser($user);
                header("Location: /home");
                exit;
            }
           else{
            $error = "invalid username or password";
            Logger::error('invalid username or password'. $error);
            }
        }


    }


    public function logout(){
       
        $this->authService->removeAuthUser();
        header("Location: /home");
        
    }
}



?>