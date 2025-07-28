<?php
namespace App\Controllers;

use Exception;
use App\Services\AuthService;
use App\Models\User;
use App\Services\UserService;
use App\Services\OtpService;
use utils\Logger;
use utils\View;
use App\Controllers\BaseController;

// use Respect\Validation\Validator as validation;

class UserController extends BaseController {
    protected  $userService;
    protected $authService;
    protected $otpService;



    public function __construct()
    {
        $this->userService = new UserService();
        $this->authService = AuthService::getInstance();
        $this->otpService = new OtpService();
    }

    public function register(){
        
        //input data
        $email = trim($_POST['email']);
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $password = trim($_POST['password']);

        //validation error to display 
        $errors = User::validateRegisterUser($email, $firstname, $lastname, $password);
        if(!empty($errors)){
            View::render('/register-user.php', 'Register User', [
                'errors' => $errors
            ]);
            return;
        }

        try{
            $registeredUser = $this->userService->registerUser($email, $firstname, $lastname, $password);
            if($registeredUser){
                $_SESSION['register_email'] = $email;
                if(! $this->otpService->send($registeredUser)){
                  throw new \Exception('Issue sending OTP to registered user');
               }
                View::render('/users/verify_otp.php', 'Verify User');
                exit();
            }
        }

        catch(\Exception $e){
            Logger::error('Failed to register user' . $e->getMessage());
            echo 'Failed to registered user'. $e->getMessage();
        }

       
    }
       
    public function login(){
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $errors = User::validateLoginUser($email, $password);
        
       
        if(empty($errors)){
           
            try{
                $response = $this->userService->loginUser($email, $password);
                
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
        $this->redirect('/home');
        
    }
}



?>