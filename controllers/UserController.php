<?php
namespace controllers;

use Exception;
use services\AuthService;
use models\User;
use services\UserService;
use utils\Logger;
use utils\View;

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
            $_SESSION['register_email'] = $email;
            header("Location: verify-otp");    
            exit();
       }else{
            Logger::error("Failed to register the user");
            View::render('/error.php', 'Failed to register the user');
       }
    }
       else{
        foreach($errors as $error){
            echo "<p> $error </p>";
        }
       }
    }

    






    public function verifyOtp(){  
        try{
        
        $otp = $_POST['otp'];
        $validUser = $this->userService->verifyOtp($otp);

        
        if($validUser->is_verified === 0){
            header("Location: /verify-otp?error= user not verified");
        }

        if($validUser){
            $this->authService->setAuthUser($validUser);
            header("Location: /home" );
        }else{
            header("Location: /verify-otp?error=Invalid or Expired OTP");
            exit();
        }
        }
        catch(Exception $e){
            header("Location: /error.php?message= " . urlencode($e->getMessage()));
            exit();
        }
    }


    public function resendOtp(){
        $email = $_SESSION['register_email'];
        $user = $this->userService->updateUserOtp($email);
        Logger::info($user);



        if($user){
            if($this->userService->sendOtp($user)){
                
                $_SESSION['verify_otp'] = array(
                    "status" => "success",
                    "message" => "OTP send successfully. Please check your email."
                );

                header("Location: /verify-otp");
                exit();
            } 
            
            $_SESSION['verify_otp'] =  array(
                "status" => "error",
                "message" => "There is some issue sending OTP. Please report issue."
            );
            header("Location: /verify-otp" );
            exit();
        }

       else{
        $_SESSION['verify_otp'] =  array(
            "status" => "error",
            "message" => "No user found."
        );
          header("Location: /error.php?message=No registered email");
          exit();
       }
    }




    public function login(){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $errors = User::validateLoginUser($email, $password);
        
       
        if(empty($errors)){
           
            try{
                $response = $this->userService->loginUser($email, $password);
                Logger::info('res ' . json_encode($response));
                if(isset( $response['status']) && $response['status'] === 'unverified'){
                   $_SESSION['verify_otp'] = array(
                        'status' => 'error',
                        'message' => $response['message']
                    );
                    $_SESSION['register_email'] = $email;
                    header("Location: /verify-otp");
                    exit();
                }
                    $this->authService->setAuthUser($response);
                    header("Location: /home");
                    exit;
            }
            catch(Exception $e){
                $_SESSION['login_error'] = $e->getMessage();
                header("Location: /login-user");
                exit();
            }
           }

           else{
              $_SESSION['login_error'] = 'Validation failed. Enter username and password';
              header('Location: /login-user');
              exit();
            }
        }


    


    public function logout(){
       
        $this->authService->removeAuthUser();
        header("Location: /home");
        
    }
}



?>